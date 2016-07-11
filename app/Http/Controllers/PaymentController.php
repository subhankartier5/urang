<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class PaymentController extends Controller
{
    public function AuthoRizePayment() {
   		$merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
		$merchantAuthentication->setName("58caF3mvU36g");
		$merchantAuthentication->setTransactionKey("5Bn652pm67JW9pZ5");
		// Create the payment data for a credit card
		$creditCard = new AnetAPI\CreditCardType();
		$creditCard->setCardNumber("4111111111111111");
		$creditCard->setExpirationDate("2038-12");
		$creditCard->setCardCode("123");
		$paymentOne = new AnetAPI\PaymentType();
		$paymentOne->setCreditCard($creditCard);
		// Create a transaction
		$transactionRequestType = new AnetAPI\TransactionRequestType();
		$transactionRequestType->setTransactionType( "authCaptureTransaction"); 
		$transactionRequestType->setAmount(151.51);
		$transactionRequestType->setPayment($paymentOne);
		$request = new AnetAPI\CreateTransactionRequest();
		$request->setMerchantAuthentication($merchantAuthentication);
		$request->setTransactionRequest( $transactionRequestType);
		$controller = new AnetController\CreateTransactionController($request);
		$response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
		if ($response != null)
		{
		    $tresponse = $response->getTransactionResponse();

		    if (($tresponse != null) && ($tresponse->getResponseCode()=="1") )   
		    {
		        echo "Charge Credit Card AUTH CODE : " . $tresponse->getAuthCode() . "\n";
		        echo "Charge Credit Card TRANS ID  : " . $tresponse->getTransId() . "\n";
		    }
		    else
		    {
		        echo  "Charge Credit Card ERROR :  Invalid response\n";
		    }
		}
		else
		{
		    echo  "Charge Credit card Null response returned";
		}

    }
}
   
