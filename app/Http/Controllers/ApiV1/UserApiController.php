<?php

namespace App\Http\Controllers\ApiV1;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;

use App\Helper\NavBarHelper;
use App\Helper\ConstantsHelper;
use App\User;
use App\UserDetails;
use App\PriceList;
use App\CustomerCreditCardInfo;
use Illuminate\Support\Facades\Auth;
use Mail;
use Hash;
use App\Neighborhood;
use App\Faq;
use App\Pickupreq;
use App\OrderDetails;
use Illuminate\Support\Facades\Validator;
use App\Categories;
use App\SchoolDonations;
use App\Cms;

class UserApiController extends Controller
{
    public function LoginAttempt(Request $req)
    {
    	//echo $req->email;
    	$user = auth()->guard('users');
    	if($user->attempt(['email' => $req->email, 'password' => $req->password]))
    	{
    		$userdata = $user->user();
    		
    		if($userdata->block_status)
    		{
    			return Response::json(array(
		            'status' => false,
		            'status_code' => 403,
		            'message' => 'This user is forbidden!'        
	        	));
    		}
    		else
    		{
    			$user_details = User::where('id',$userdata->id)->with('user_details')->get();
	        	return Response::json(array(
		            'status' => true,
		            'status_code' => 200,
		            'response' => $user_details        
	        	));
    		}
    		
    	}
    	else
    	{
    		return Response::json(array(
	            'status' => false,
	            'status_code' => 400,
	            'message' => "User not found! Check the email and password."
        	));
    	}
    	
    }
    public function order_history(Request $req)
    {
    	$data['user_id'] = $req->user_id;
    	$pickups = Pickupreq::where($data)->orderBy('id', 'desc')->with('order_detail')->get();

    	if($pickups)
    	{
    		return Response::json(array(
	            'status' => true,
	            'status_code' => 200,
	            'response' => $pickups,        
	    	));
    	}
    	else
    	{
    		return Response::json(array(
	            'status' => true,
	            'status_code' => 400,
	            'message' => 'No order history found'        
	    	));
    	}

    	
    }
    public function placeOrder(Request $request)
    {
    	$total_price = 0.00;
        $pick_up_req = new Pickupreq();
        $pick_up_req->user_id = $request->user_id;
        $pick_up_req->address = $request->address;
        $pick_up_req->pick_up_date = date("Y-m-d", strtotime($request->pick_up_date));
        $pick_up_req->pick_up_type = $request->order_type == 1 ? 1 : 0;
        $pick_up_req->schedule = $request->schedule;
        $pick_up_req->delivary_type = $request->boxed_or_hung;
        $pick_up_req->starch_type = $request->strach_type;
        $pick_up_req->need_bag = isset($request->urang_bag) ? $request->urang_bag : 0;
        $pick_up_req->door_man = $request->doorman;
        $pick_up_req->special_instructions = isset($request->spcl_ins) ? $request->spcl_ins: null;
        $pick_up_req->driving_instructions = isset($request->driving_ins) ? $request->driving_ins : null;
        $pick_up_req->payment_type = $request->pay_method;
        $pick_up_req->order_status = 1;
        $pick_up_req->is_emergency = isset($request->isEmergency) ? $request->isEmergency : 0;
        $pick_up_req->client_type = $request->client_type;
        $pick_up_req->coupon = NULL;
        $pick_up_req->wash_n_fold = $request->wash_n_fold;
        $data_table = json_decode($request->list_items_json);
        for ($i=0; $i< count($data_table); $i++) {
            $total_price += $data_table[$i]->item_price*$data_table[$i]->number_of_item;
        }
        $pick_up_req->total_price = $request->order_type == 1 ? 0.00 : $total_price;

        if ($pick_up_req->save()) 
        {
            if ($request->order_type == 1) {
                //fast pick up
                //return redirect()->route('getPickUpReq')->with('success', "Thank You! for submitting the order we will get back to you shortly!");
                $order['order_type'] = 1;
                return Response::json(array(
		            'status' => true,
		            'status_code' => 200,
		            'response' => $order,
		            'message' => "Thank You! for submitting the order we will get back to you shortly!"        
		    	));

            }
            else
            {
                //detailed pick up
                $order['order_type'] = 0;
                $data = json_decode($request->list_items_json);
                for ($i=0; $i< count($data); $i++) {
                    $order_details = new OrderDetails();
                    $order_details->pick_up_req_id = $pick_up_req->id;
                    $order_details->user_id = auth()->guard('users')->user()->id;
                    $order_details->price = $data[$i]->item_price;
                    $order_details->items = $data[$i]->item_name;
                    $order_details->quantity = $data[$i]->number_of_item;
                    $order_details->payment_status = 0;
                    $order_details->save();
                }
                //return redirect()->route('getPickUpReq')->with('success', "Thank You! for submitting the order we will get back to you shortly!");
                return Response::json(array(
		            'status' => true,
		            'status_code' => 200,
		            'response' => $order,
		            'message' => "Thank You! for submitting the order we will get back to you shortly!"        
		    	));
            }
        }
        else
        {
            return Response::json(array(
		            'status' => false,
		            'status_code' => 500,
		            'message' => "Sorry! Cannot save the order now!"        
		    	));
        }
    }

    public function checkEmail(Request $request)
    {
        if(User::where('email',$request->email)->first()) 
        {
            return Response::json(array(
                        'status' => false,
                        'status_code' => 400,
                        'message' => "This email already exists!"        
                    ));
        }
        else
        {
            return Response::json(array(
                        'status' => true,
                        'status_code' => 200,
                        'message' => "Email can be taken!"        
                    ));
        }
    }

    public function userSignUp(Request $request)
    {
    	if ($request->password == $request->conf_password) {

			if(User::where('email',$request->email)->first()) 
			{
			    return Response::json(array(
				            'status' => false,
				            'status_code' => 400,
				            'message' => "This email already exists!"        
				    	));
			}
			else 
			{
				
			 	$user = new User();
	            $user->email = $request->email;
	            $user->password = bcrypt($request->password);
	            $user->block_status = 0;
	            if ($user->save()) {
	                $user_details = new UserDetails();
	                $user_details->user_id = $user->id;
	                $user_details->name = $request->name;
	                $user_details->address = $request->address;
	                $user_details->personal_ph = $request->personal_phone;
	                $user_details->cell_phone = isset($request->cell_phone) ? $request->cell_phone : NULL;
	                $user_details->off_phone = isset($request->office_phone) ? $request->office_phone : NULL;
	                $user_details->spcl_instructions = isset($request->spcl_instruction) ? $request->spcl_instruction : NULL;
	                $user_details->driving_instructions = isset($request->driving_instruction) ? $request->driving_instruction : NULL;
	                if ($user_details->save()) {
	                    $card_info = new CustomerCreditCardInfo();
	                    $card_info->user_id = $user_details->user_id;
	                    $card_info->name = $request->cardholder_name;
	                    $card_info->card_no = $request->card_no;
	                    $card_info->card_type = $request->cardtype;
	                    $card_info->cvv = isset($request->cvv) ? $request->cvv : NULL;
	                    $card_info->exp_month = $request->select_month;
	                    $card_info->exp_year = $request->select_year;
	                    if ($card_info->save()) {
	                        
	                         //return redirect()->route('getLogin')->with('success', 'You have successfully registered please login');
	                    	$data['user_id'] = $card_info->user_id;
	                    	return Response::json(array(
					            'status' => true,
					            'status_code' => 200,
					            'response' => $data,
					            'message' => "Registration successfull"        
					    	));
	                    }
	                    else
	                    {
	                        return Response::json(array(
					            'status' => false,
					            'status_code' => 500,
					            'message' => "Sorry! Cannot save your card details!"        
					    	));
	                    }
	                }
	                else
	                {
	                	return Response::json(array(
					            'status' => false,
					            'status_code' => 500,
					            'message' => "Sorry! Cannot save your user details!"        
					    	));
	                    
	                }
	            }
	            else
	            {                
	                	return Response::json(array(
					            'status' => false,
					            'status_code' => 500,
					            'message' => "Sorry! Cannot save your user details!"        
					    	));
	            }   
			}
            
        }
        else
        {
            return Response::json(array(
				            'status' => false,
				            'status_code' => 400,
				            'message' => "Password and Confirm Password did not matched!"        
				    	));
        }
    }

    public function getPrices()
    {
    	$price_list = Categories::with('pricelists')->get();
    	if($price_list)
    	{
    		return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => $price_list        
			    	));
    	}
    	else
    	{
    		return Response::json(array(
			            'status' => false,
			            'status_code' => 400,
			            'message' => "No price list to show!"        
			    	));
    	}
    }
    public function getNeighborhood()
    {
    	$obj = new NavBarHelper();
        $neighborhood = $obj->getNeighborhood();
        if($neighborhood)
        {
        	return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => $neighborhood        
			    	));
        }
        else
        {
        	return Response::json(array(
			            'status' => false,
			            'status_code' => 400,
			            'message' => "No neighborhood to show!"        
			    	));
        }
    }
    public function getFaq()
    {
    	$faqs = Faq::all();
    	if($faqs)
    	{
    		return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => $faqs        
			    	));
    	}
    	else
    	{
    		return Response::json(array(
			            'status' => false,
			            'status_code' => 400,
			            'message' => "No Faqs to show!"        
			    	));
    	}
    }
    public function contactUs(Request $request)
    {
    	

    	$firstname = $request->firstName;
        $lastname = $request->lastName;
        $email = $request->email;
        $subject = $request->subject;
        $text = $request->message;
        //dd($message);
        $phone = $request->phone;

            $flag=Mail::send('pages.sendEmailContact', ['firstName'=>$firstname,'lastName'=>$lastname,'email'=>$email,'subject'=>$subject,'text'=>$text,'phone'=>$phone], function($msg) use($request)
                        {
                            $msg->from($request->email, 'U-rang');
                            $msg->to("work@tier5.us", $request->firstName)->subject('U-rang Details');
                        });

            if($flag==1)
            {
                return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => 1,
			            'message' => "Email is sent"        
			    	));
            }
            else
            {
                return Response::json(array(
			            'status' => false,
			            'status_code' => 500,
			            'message' => "Email is not sent!"        
			    	));
            }
    }
    public function updateProfile(Request $request)
    {

        $update_id = $request->user_id;
        //dd($update_id);
        if(User::where('email',$request->email)->first()) 
		{
		    return Response::json(array(
			            'status' => false,
			            'status_code' => 400,
			            'message' => "This email already exists!"        
			    	));
		}
        $user = User::find($update_id);
        //dd($user);
        $user->email = $request->email;
        if ($user->save()) {
            $user_details = UserDetails::where('user_id', $update_id)->first();
            //dd($user_details);
            $user_details->user_id = $update_id;
            $user_details->name = $request->name;
            $user_details->address = $request->address;
            $user_details->personal_ph = $request->personal_phone;
            $user_details->cell_phone = $request->cell_phone != null ? $request->cell_phone : '';
            $user_details->off_phone = $request->office_phone != null ? $request->office_phone: '';
            $user_details->spcl_instructions = $request->spcl_instruction != null ? $request->spcl_instruction: '';
            $user_details->driving_instructions = $request->driving_instruction != null ? $request->driving_instruction : '';
            if ($user_details->save()) {
                $card_info = CustomerCreditCardInfo::where('user_id' , $update_id)->first();
                //dd($card_info);
                $card_info->user_id = $update_id;
                $card_info->name = $request->cardholder_name;
                $card_info->card_no = $request->card_no;
                $card_info->card_type = $request->cardtype;
                $card_info->cvv = $request->cvv;
                $card_info->exp_month = $request->select_month;
                $card_info->exp_year = $request->select_year;
                if ($card_info->save()) {

                    return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => 1,
			            'message' => "Details successfully updated!"        
			    	));
                }
                else
                {
                   return Response::json(array(
			            'status' => false,
			            'status_code' => 500,
			            'message' => "Could not save your card details!"        
			    	)); 
                }
            }
            else
            {
                return Response::json(array(
			            'status' => false,
			            'status_code' => 500,
			            'message' => "Could not save your user details!"        
			    	));
            }
        }
        else
        {
            return Response::json(array(
			            'status' => false,
			            'status_code' => 500,
			            'message' => "Could not save your user details!"        
			    	));
        }
    }
    public function changePassword(Request $request)
    {
    	if ($request->new_password == $request->conf_password) {
            $id = $request->user_id;
            $old_password = $request->old_password;
            $new_password = $request->new_password;
            $user = User::find($id);
            if (Hash::check($old_password, $user->password)) {
                $user->password = bcrypt($new_password);
                if ($user->save()) {
                    return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => 1,
			            'message' => "Password successfully updated!"        
			    	));
                }
                else
                {
                   return Response::json(array(
			            'status' => false,
			            'status_code' => 500,
			            'message' => "Could not save your password now! Please try again later!"        
			    	)); 
                }
            }
            else
            {
                return Response::json(array(
			            'status' => false,
			            'status_code' => 400,
			            'message' => "Old password did not matched with our!"        
			    	));
            }
        }
        else
        {
            return Response::json(array(
			            'status' => false,
			            'status_code' => 400,
			            'message' => "Password and confirm password did not matched!"        
			    	));
        }
    }
    public function deletePickup(Request $request)
    {
    	$id_to_del = $request->pickup_id;
        $search = Pickupreq::find($id_to_del);
        if ($search) {
           if ($search->pick_up_type == 0) {
                $search->delete();
                $search_order_details = OrderDetails::where('pick_up_req_id', $id_to_del)->get();
                foreach ($search_order_details as $details) {
                    $details->delete();
                }
                return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => 1,
			            'message' => "Detailed pickup successfully deleted!"        
			    	));
           }
           else
           {
                if ($search->delete()) {
                    return Response::json(array(
			            'status' => true,
			            'status_code' => 200,
			            'response' => 1,
			            'message' => "Fast pickup successfully deleted!"        
			    	));
                }
                else
                {
                    return Response::json(array(
			            'status' => false,
			            'status_code' => 500,
			            'message' => "Could not delete the pickup!"        
			    	)); 
                }
           }
        }
        else
        {
           return Response::json(array(
			            'status' => false,
			            'status_code' => 400,
			            'message' => "Cannot find the pickup you are looking for!"        
			    	));
        }
    }
    public function postPickUpType(Request $request) {
        //return $request->id;
        if (trim($request->id) != null) {
            $pick_up_req = Pickupreq::where('user_id',$request->id)->get();
            $placed_order = 0;
            $picked_up_order = 0;
            $processed_order = 0;
            $delivered_order =0;
            foreach ($pick_up_req as $req) {
                $order_status = $req->order_status;
                switch ($order_status) {
                  case '1':
                    $placed_order++;
                    break;
                  case '2':
                     $picked_up_order++;
                    break;
                  case '3':
                     $processed_order++;
                    break;
                  case '4':
                     $delivered_order++;
                    break;
                  default:
                    echo "Something went wrong error!";
                    break;
                }
            }
            return Response::json(array(
                'status' => true ,
                'status_code' => 200,
                'response' => array(
                    'total_pick_up' => count($pick_up_req),
                    'scheduled_pick_up' => $placed_order,
                    'picked_up_order' => $picked_up_order,
                    'processed_pick_up' => $processed_order,
                    'delivered_pick_up_req' => $delivered_order
                )
            ));
        }
        else
        {
            return Response::json(array(
                'status' => false ,
                'status_code' => 400,
                'message' => 'User id cannot be null!'
            ));
        }
    }
    public function postSchoolLists() {
        $school_list = SchoolDonations::all();
        if ($school_list) {
           return Response::json(array(
                'status' => true,
                'status_code' => 200,
                'response' => $school_list
            ));
        }
        else
        {
            return  Response::json(array(
                'status' => false ,
                'status_code' => 400,
                'message' => 'No School exists!'
            ));
        }
    }
    public function postServicesApi(Request $request) {
        switch ($request->id) {
            case '0':
                $services = Cms::where('identifier', 0)->first();
                if ($services) {
                    return Response::json(array(
                        'status' => true,
                        'status_code' => 200,
                        'response' => $services
                    ));
                }
                else
                {
                    return Response::json(array(
                        'status' => false,
                        'status_code' => 400,
                        'message' => 'admin has not added any details yet!'
                    ));
                }
                break;
            case '1':
                $services = Cms::where('identifier', 1)->first();
                if ($services) {
                    return Response::json(array(
                        'status' => true,
                        'status_code' => 200,
                        'response' => $services
                    ));
                }
                else
                {
                    return Response::json(array(
                        'status' => false,
                        'status_code' => 400,
                        'message' => 'admin has not added any details yet!'
                    ));
                }
                break;
            case '2':
                $services = Cms::where('identifier', 2)->first();
                if ($services) {
                    return Response::json(array(
                        'status' => true,
                        'status_code' => 200,
                        'response' => $services
                    ));
                }
                else
                {
                    return Response::json(array(
                        'status' => false,
                        'status_code' => 400,
                        'message' => 'admin has not added any details yet!'
                    ));
                }
                break;
            case '3':
                $services = Cms::where('identifier', 3)->first();
                if ($services) {
                    return Response::json(array(
                        'status' => true,
                        'status_code' => 200,
                        'response' => $services
                    ));
                }
                else
                {
                    return Response::json(array(
                        'status' => false,
                        'status_code' => 400,
                        'message' => 'admin has not added any details yet!'
                    ));
                }
                break;
            case '4':
                $services = Cms::where('identifier', 4)->first();
                if ($services) {
                    return Response::json(array(
                        'status' => true,
                        'status_code' => 200,
                        'response' => $services
                    ));
                }
                else
                {
                    return Response::json(array(
                        'status' => false,
                        'status_code' => 400,
                        'message' => 'admin has not added any details yet!'
                    ));
                }
                break;
            default:
                return  Response::json(array(
                    'status' => false ,
                    'status_code' => 400,
                    'message' => 'Bad request!'
                ));
                break;
        }
    }

    public function userDetails(Request $request)
    {
        $user_details = User::where('id',$request->user_id)->with('user_details','card_details')->first();
        if($user_details)
        {
            return  Response::json(array(
                    'status' => true,
                    'status_code' => 200,
                    'response' => $user_details
                ));
        }
        else
        {
            return  Response::json(array(
                    'status' => false ,
                    'status_code' => 400,
                    'message' => 'User does not exists! Please try to login again.'
                ));
        }
    } 
}
