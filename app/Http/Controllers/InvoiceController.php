<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Invoice;

class InvoiceController extends Controller
{
    public function index() {
    	dd($data);
    	return view('invoices.invoice');
    }
    public function postInvoice(Request $request) {
    	for ($i=0; $i < $request->loop_limit ; $i++) { 
    		$save_invoice = new Invoice();
    		$save_invoice->user_id = $request->req_user_id;
    		$save_invoice->pick_up_req_id = $request->pick_up_req_id;
    		$save_invoice->invoice_id = time();
    		$save_invoice->item = $request->items[$i];
    		$save_invoice->quantity = $request->qty[$i];
    		$save_invoice->price = $request->price[$i];
    		$save_invoice->save();
    	}
    	return redirect()->route('getCustomerOrders')->with('success', "Invoice Successfully created");
    }
    public function postDeleteInvoice(Request $request) {
    	//return $request;
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
