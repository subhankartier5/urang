<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Staff;

use App\User;

use App\Pickupreq;

use App\UserDetails;

use Illuminate\Support\Facades\Input;

use Session;

class StaffController extends Controller
{

    public function LoginAttempt(Request $request) 
    {
        
        $staff = auth()->guard('staffs');
        $user_name = $request->email;
        $password = $request->password;
        $remember_me = isset($request->remember)? true : false;
        //dd($remember_me);
        if ($staff->attempt(['user_name' => $user_name, 'password' => $password], $remember_me)) {
            return redirect()->route('getStaffIndex');
        }
        else
        {
            return redirect()->route('getStaffLogin')->with('fail', 'wrong username or password');
        }
    }

    public function getLogout() {
        $user = auth()->guard('staffs');
        $user->logout();
        return redirect()->route('getStaffLogin');
    }

    public function getStaffLogin()
    {
        return view('staff.login');
    }

    public function getStaffIndex()
    {
        $staff = auth()->guard('staffs')->user();
        if($staff)
        {
            $pickups = Pickupreq::with('user_detail','user','order_detail')->get();
            $orders_to_pick_up = Pickupreq::where('order_status',1)->with('user_detail','user','order_detail')->get();
            $orders_picked_up = Pickupreq::where('order_status',2)->with('user_detail','user','order_detail')->get();
            $orders_processed = Pickupreq::where('order_status',3)->with('user_detail','user','order_detail')->get();
            $orders_delivered = Pickupreq::where('order_status',4)->with('user_detail','user','order_detail')->get();
            return view('staff.index',compact('pickups','orders_to_pick_up','orders_picked_up','orders_processed','orders_delivered'));
        }
        else
        {
            return redirect()->route('getStaffLogin');
        }
        
    }


    public function getStaffOrders()
    {
        $staff = auth()->guard('staffs')->user();
        if($staff)
        {
            $pickups = Pickupreq::orderBy('id', 'desc')->with('user_detail','user','order_detail')->get();
            //dd($user);
            return view('staff.orders',compact('pickups'));
        }
        else
        {
            return redirect()->route('getStaffLogin');
        }
        
    }

    public function changeOrderStatus(Request $req)
    {
        $staff = auth()->guard('staffs')->user();
        if($staff)
        {
            //dd($req);
            $total_price = isset($req->total_price)? $req->total_price : false;
            if($total_price)
            {
                $data['order_status'] = $req->order_status;
                $data['total_price'] = $total_price;
                //print_r($data);
                $result = Pickupreq::where('id', $req->pickup_id)->update($data);
                if($result)
                {
                    return redirect()->route('getStaffOrders')->with('success', 'Order Status successfully updated!');
                }
                else
                {
                    return redirect()->route('getStaffOrders')->with('error', 'Failed to update Order Status!');
                }
            }
            else
            {
                $result = Pickupreq::where('id', $req->pickup_id)->update(['order_status' => $req->order_status]);
                if($result)
                {
                    return redirect()->route('getStaffOrders')->with('success', 'Order Status successfully updated!');
                }
                else
                {
                    return redirect()->route('getStaffOrders')->with('error', 'Failed to update Order Status!');
                }
            }
        }
        else
        {
            return redirect()->route('getStaffLogin');
        }

        
    }

    public function getSearch()
    {
        $search = Input::get('search');
        
        
        $staff = auth()->guard('staffs')->user();
        if($staff)
        {
            $pickups = Pickupreq::where('id',$search)->with('user_detail','user','order_detail')->get();
            if($pickups)
            {
                Session::put('success', 'Search result found!');
                return view('staff.orders',compact('pickups'));
            }
            else
            {
                Session::put('error', 'Search result not found!');
                return view('staff.orders',compact('pickups'));
            }
            
        }
        else
        {
            return redirect()->route('getStaffLogin');
        }

    }



}
