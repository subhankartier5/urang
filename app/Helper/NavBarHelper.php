<?php
namespace App\Helper;
use Session;
use Illuminate\Support\Facades\Auth;
use App\SiteConfig;
use App\User;
use App\CustomerCreditCardInfo;
use App\UserDetails;
use App\Neighborhood;
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
		if (auth()->guard('users')->user() != null) {
			$logged_id = auth()->guard('users')->user()->id;
			$customer_details = User::with('user_details', 'card_details')->where('id' , $logged_id)->first();
			return $customer_details;
		}
		else
		{
			$customer_details = null;
			return $customer_details;
		}
	}
	public function getNeighborhood() {
		$neighborhood = Neighborhood::all();
		return $neighborhood;
	}
	public function test()
	{
		return "test";
	}

	public function staffDetails()
	{
		$staff = auth()->guard('staffs')->user();

		return $staff;
	}
}