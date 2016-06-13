<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Redirect;

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
    	$user_data = Auth::user();
    	return view('admin.dashboard', compact('user_data'));
    }
    public function logout() {
    	Auth::logout();
    	return redirect()->route('get-admin-login');
    }
}
