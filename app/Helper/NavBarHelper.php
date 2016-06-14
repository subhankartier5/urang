<?php
namespace App\Helper;
use Session;
use Illuminate\Support\Facades\Auth;
/**
* 
*/
class NavBarHelper 
{

	public function getUserData() {
		$user_data = Auth::user();
		return $user_data;
	}
}