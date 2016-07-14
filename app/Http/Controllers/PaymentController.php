<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use App\Helper\NavBarHelper;
use App\PaymentKeys;
use App\Pickupreq;
use App\CustomerCreditCardInfo;
use App\Invoice;
class PaymentController extends Controller
{
	public function getPayment() {
		$obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();
        $payment_keys = PaymentKeys::first();
        $user_details = Pickupreq::where('payment_type',1)->where('payment_status', 0)->with('user')->get();
		return view('admin.payment', compact('user_data', 'payment_keys', 'user_details', 'site_details'));
	}
    public function AuthoRizePayment(Request $auth_request) {
    	//dd($auth_request);
   		$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
   		$payment_keys = PaymentKeys::first();
   		//dd($payment_keys);
   		if ($payment_keys != null) {
   			$merchantAuthentication->setName($payment_keys->login_id);
			$merchantAuthentication->setTransactionKey($payment_keys->transaction_key);
			// Create the payment data for a credit card
			$creditCard = new AnetAPI\CreditCardType();
			$creditCard->setCardNumber($auth_request->card_no);
			$creditCard->setExpirationDate($auth_request->exp_date);
			$creditCard->setCardCode($auth_request->cvv);
			$paymentOne = new AnetAPI\PaymentType();
			$paymentOne->setCreditCard($creditCard);
			// Create a transaction
			$transactionRequestType = new AnetAPI\TransactionRequestType();
			$transactionRequestType->setTransactionType( "authCaptureTransaction"); 
			$transactionRequestType->setAmount($auth_request->amount);
			$transactionRequestType->setPayment($paymentOne);
			$request = new AnetAPI\CreateTransactionRequest();
			$request->setMerchantAuthentication($merchantAuthentication);
			$request->setTransactionRequest( $transactionRequestType);
			$controller = new AnetController\CreateTransactionController($request);
			if ($payment_keys->mode == 1) {
				$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
			}
			else
			{
				$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
			}
			if ($response != null)
			{
			    $tresponse = $response->getTransactionResponse();
			    if (($tresponse != null) && ($tresponse->getResponseCode()=="1") )   
			    {
			        return redirect()->route('getPayment')->with('success', "Payment was successfull!");
			    }
			    else
			    {
			        return redirect()->route('getPayment')->with('fail', "Payment Failed check card details and try again later!"); 
			    }
			}
			else
			{
			    return redirect()->route('getPayment')->with('fail', "Payment Failed check card details and try again later!"); 
			}
   		}
   		else
   		{
   			return redirect()->route('getPayment')->with('fail', "No Payment keys found! Please fill up your payment keys and try again!"); 
   		}
    }
    public function postPaymentKeys(Request $request) {
    	$payment_keys = PaymentKeys::first();
    	if ($payment_keys != null) {
    		$payment_keys->login_id = trim($request->authorize_id);
    		$payment_keys->transaction_key = trim($request->tran_key);
	    	$payment_keys->mode = $request->mode;
	    	if ($payment_keys->save()) {
	    		return redirect()->route('getPayment')->with('success', "Account Details Successfully Saved!");
	    	}
	    	else
	    	{
	    		return redirect()->route('getPayment')->with('fail', "Failed to save details");
	    	}
    	}
    	else
    	{
    		$save_details = new PaymentKeys();
	    	$save_details->login_id = trim($request->authorize_id);
	    	$save_details->transaction_key = trim($request->tran_key);
	    	$save_details->mode = $request->mode;
	    	if ($save_details->save()) {
	    		return redirect()->route('getPayment')->with('success', "Account Details Successfully Saved!");
	    	}
	    	else
	    	{
	    		return redirect()->route('getPayment')->with('fail', "Failed to save details");
	    	}
    	}
    }
    public function postMarkAsPaid(Request $request) {
    	//return $request;
    	$search_req = Pickupreq::find($request->pick_up_req_id);
    	//return $search_req;
    	if ($search_req) {
    		$search_req->payment_status = 1;
    		if ($search_req->save()) {
    			return 1;
    		}
    		else
    		{
    			return 0;
    		}
    	}
    	else
    	{
    		return 0;
    	}
    }
}
   
