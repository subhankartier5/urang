<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Helper\NavBarHelper;
use Hash;
use App\Admin;

class AdminController extends Controller
{
    public function index() {
    	if (Auth::check()) {
    		return redirect()->route('get-admin-dashboard');
    	}
    	else
    	{
    		return view('admin.login');
    	}
    }
    public function LoginAttempt(Request $request) {
    	//dd($request);
    	$email = $request->email;
    	$password = $request->password;
    	$remember_me = isset($request->remember)? true : false;
    	//dd($remember_me);
    	if (Auth::attempt(['email' => $email, 'password' => $password], $remember_me)) {
            return redirect()->route('get-admin-dashboard');
        }
        else
        {
        	return redirect()->route('get-admin-login')->with('fail', 'wrong username or password');
        }
    }
    public function getDashboard() {
    	$obj = new NavBarHelper();
        $user_data = $obj->getUserData();
    	return view('admin.dashboard', compact('user_data'));
    }
    public function logout() {
    	Auth::logout();
    	return redirect()->route('get-admin-login');
    }
    public function getProfile() {
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        return view('admin.admin-profile', compact('user_data'));
    }
    public function postProfile(Request $request) {
        $id = Auth::user()->id;
        $password = $request->password;
        $search = Admin::find($id);
        if ($search) {
            if (Hash::check($request->user_password, $search->password)) {
                $search->username = $request->user_name;
                $search->email = $request->user_email;
                if ($search->save()) {
                   return redirect()->route('get-admin-profile')->with('success', 'records successfully updated');
                }
                else
                {
                    return redirect()->route('get-admin-profile')->with('error', 'Cannot update your details right now tray again later');
                }

            }
            else
            {
                return redirect()->route('get-admin-profile')->with('error', 'Password did not match with our record');
            }
        }
        else
        {
            return redirect()->route('get-admin-profile')->with('error', 'Could not find your details try again later');
        }
    }
}
