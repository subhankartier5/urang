<?php
namespace App\Helper;
use Session;
use Illuminate\Support\Facades\Auth;
use App\SiteConfig;
use App\User;
use App\CustomerCreditCardInfo;
use App\UserDetails;
use App\Neighborhood;
class ConstantsHelper 
{
	public function getPagination() {
		return 10;
	}
	public function getClintEmail()
	{
		return "work@tier5.us";
	}
	
}