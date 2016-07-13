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
use Auth;
use App\OrderDetails;

class StaffController extends Controller
{
    public function __construct()
    {
        $paginate_limit = 2;
    }
    

    public function LoginAttempt(Request $request) 
    {
        
        $staff = auth()->guard('staffs');
        $user_name = $request->email;
        $password = $request->password;
        $remember_me = isset($request->remember)? true : false;
        //dd($remember_me);
        if ($staff->attempt(['user_name' => $user_name, 'password' => $password], $remember_me)) {
            $active = $staff->user()->active;
            if($active)
            {
                return redirect()->route('getStaffIndex');
            }
            else
            {
                return redirect()->route('getStaffLogin')->with('fail', 'This staff is blocked by admin!');
            }
            
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
            $pickups = Pickupreq::orderBy('id','desc')->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
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
            $pickups = Pickupreq::orderBy('id', 'desc')->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
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
            $pickups = Pickupreq::where('id',$search)->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
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
    public function getSort()
    {
        $input = Input::get('sort');
        $sort = isset($input) ? $input : false;

        if($sort)
        {
            $pickups = Pickupreq::orderBy($sort,'desc')->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
            return view('staff.orders',compact('pickups'));
        }
        else
        {
            return redirect()->route('getStaffOrders');
        }

    }

    public function addItemCustom(Request $request)
    {
        //dd($request);
        $data = json_decode($request->list_items_json);

        $user = Pickupreq::find($request->row_id);
        $previous_price = $user->total_price;
        $price_to_add = 0.00;
        
        for ($i=0; $i< count($data); $i++) 
        {
            $order_details = new OrderDetails();
            $order_details->pick_up_req_id = $request->row_id;
            $order_details->user_id = $request->row_user_id;
            $order_details->price = $data[$i]->item_price;
            $order_details->items = $data[$i]->item_name;
            $order_details->quantity = $data[$i]->number_of_item;
            $order_details->payment_status = 0;

            $price_to_add = ($price_to_add+($data[$i]->item_price*$data[$i]->number_of_item));
            
            $order_details->save();
        }
        $user->total_price = $previous_price+$price_to_add;
        if($user->save())
        {
            return redirect()->route('getStaffOrders')->with('success', 'Order successfully updated!');
        }
        else
        {
            return redirect()->route('getStaffOrders')->with('error', 'Cannot update the order now!');
        }
        

    }



}
