<?php
namespace App\Helper;
use Session;
use Illuminate\Support\Facades\Auth;
use App\SiteConfig;
use App\User;
use App\CustomerCreditCardInfo;
use App\UserDetails;
class NavBarHelper 
{
	public function getUserData() {
		$user_data = Auth::user();
		return $user_data;
	}
	public function siteData() {
		$site_details = SiteConfig::first();
		return $site_details;
	}
	public function getCustomerData() {
		$logged_id = auth()->guard('users')->user()->id;
		$customer_details = User::with('user_details', 'card_details')->where('id' , $logged_id)->first();
		return $customer_details;
	}
}