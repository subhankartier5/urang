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
}
