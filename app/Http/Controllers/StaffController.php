<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Staff;

use App\User;

use App\Pickupreq;

use App\UserDetails;

class StaffController extends Controller
{
    public function getStaffIndex()
    {
    	return view('staff.index');
    }


    public function getStaffOrders()
    {
    	$pickups = Pickupreq::with('user_detail','user','order_detail')->get();
    	//dd($user);
    	return view('staff.orders',compact('pickups'));
    }

}
