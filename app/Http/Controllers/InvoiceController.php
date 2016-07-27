<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Invoice;
use App\Pickupreq;
class InvoiceController extends Controller
{
    public function index() {
    	dd($data);
    	return view('invoices.invoice');
    }
    public function postInvoice(Request $request) {
        //dd($request);
        $total_price = 0.00;
        $itemList=explode(',',$request->list_item);
         for($i=0;$i<count($itemList);$i++)
         {
            $items=$itemList[$i];
            if($items!='')
            {
                $item_each = explode('-', $items);
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
    public function postDeleteInvoice(Request $request) {
    	$search = Invoice::where('invoice_id', $request->invoice_id)->get();
    	foreach ($search as $element) {
    		$element->delete();
    	}
    	return 1;
    }
    public function showInvoiceUser(Request $request) {
    	//return $request; Full texts	
    	$search_invoice = Invoice::where('pick_up_req_id', $request->id)->with('user', 'user_details', 'pick_up_req')->get();
    	if (count($search_invoice) > 0) {
    		return view('invoices.invoice', compact('search_invoice'));
    	}
    	else
    	{
    		return redirect()->route('getMyPickUp')->with('fail', 'Invoice is not generated yet by admin');
    	}
    }
}
