<?php
namespace App\Helper;
use Session;
use App\CustomerCreditCardInfo;
class SiteHelper 
{
	public function showCardNumber($user_id) {
		//return $user_id;
		$card_details = CustomerCreditCardInfo::where('user_id', $user_id)->first();
		return $card_details;
	}
	
}