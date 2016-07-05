<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Staff;

class StaffController extends Controller
{
    public function getStaffIndex()
    {
    	return view('staff.index');
    }
<<<<<<< HEAD

    public function getStaffOrders()
    {
    	return view('staff.orders');
    }
=======
>>>>>>> af447319cb25ae180cb28d2b5eefbebcd3f91258
}
