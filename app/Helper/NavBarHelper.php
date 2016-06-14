<?php
namespace App\Helper;
use Session;
use Illuminate\Support\Facades\Auth;
use App\SiteConfig;
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
}