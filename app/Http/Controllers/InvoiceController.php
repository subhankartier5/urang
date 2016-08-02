<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Invoice;
use App\Pickupreq;
use App\SchoolDonations;
use App\SchoolDonationPercentage;
use App\UserDetails;
class InvoiceController extends Controller
{
    /*public function index() {
    	dd($data);
    	return view('invoices.invoice');
    }*/
    public function postInvoice(Request $request) {
        //dd("here");
        if ($request->list_item != null) {
            $total_price = 0.00;
            $itemList=explode(',',$request->list_item);
             for($i=0;$i<count($itemList);$i++)
             {
                $items=$itemList[$i];
                if($items!='')
                {
                    $item_each = explode('^%', $items);
                    for ($j=0; $j <count($item_each) ; $j++) { 
                        $item_name = $item_each[2];
                        $qty = $item_each[1];
                        $price =$item_each[3];
                    }
                    $save_invoice = new Invoice();
                    $save_invoice->user_id = $request->req_user_id;
                    $save_invoice->pick_up_req_id = $request->pick_up_req_id;
                    $save_invoice->invoice_id = time();
                    $save_invoice->item = $item_name;
                    $save_invoice->quantity = $qty;
                    $save_invoice->price = $price;
                    $total_price += $qty*$price;
                    $save_invoice->save();
                }
             }
             //dd($request->pick_up_req_id);
             $payOrNot= Pickupreq::find($request->pick_up_req_id);
             //dd();
             //$user_info = UserDetails::where('user_id', $request->req_user_id)->first();
             if ($payOrNot->school_donation_id != null) {
                $fetch_percentage = SchoolDonationPercentage::first();
                $new_percentage = $fetch_percentage->percentage/100;
                $school = SchoolDonations::find($payOrNot->school_donation_id);
                $present_pending_money = $school->pending_money;
                $updated_pending_money = $present_pending_money+($total_price*$new_percentage);
                $school->pending_money = $updated_pending_money;
                $school->save();
             }
             $search_pickupreq = Pickupreq::find($request->pick_up_req_id);
             $search_pickupreq->total_price = $total_price;
             if ($search_pickupreq->save()) {
                if ($request->identifier == 'staff') {
                    return redirect()->route('getStaffOrders')->with('success', "Invoice Successfully created");
                }

                else  {
                   return redirect()->route('getCustomerOrders')->with('success', "Invoice Successfully created");
                }
            }
            else
            {
                if ($request->identifier == 'staff') {
                    return redirect()->route('getStaffOrders')->with('fail', "Some error occured failed to update total price");
                }
                else
                {
                    return redirect()->route('getCustomerOrders')->with('fail', "Some error occured failed to update total price");
                }
                
            }
        }
        else
        {
            if ($request->identifier == 'staff') {
                return redirect()->route('getStaffOrders')->with('fail', "Please select atleast one list item");
            }
            else
            {
                return redirect()->route('getCustomerOrders')->with('fail', "Please select atleast one list item");
            }
        }
    }
    public function postDeleteInvoice(Request $request) {
    	$search = Invoice::where('invoice_id', $request->invoice_id)->get();
    	foreach ($search as $element) {
    		$element->delete();
    	}
    	return 1;
    }
    public function showInvoiceUser(Request $request) {
    	$search_invoice = Invoice::where('pick_up_req_id', $request->id)->with('user', 'user_details', 'pick_up_req')->get();
        $school_details_id = 0;
    	if (count($search_invoice) > 0) {
            for ($i=0; $i < 1; $i++) { 
                $school_details_id = $search_invoice[$i]->pick_up_req->school_donation_id;
            }
            $school_details = SchoolDonations::find($school_details_id);
            $school_donation_per = SchoolDonationPercentage::first();
    		return view('invoices.invoice', compact('search_invoice', 'school_details', 'school_donation_per'));
    	}
    	else
    	{
    		return redirect()->route('getMyPickUp')->with('fail', 'Invoice is not generated yet by admin');
    	}
    }
}
