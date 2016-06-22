<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Helper\NavBarHelper;
use App\User;
use App\UserDetails;
use App\CustomerCreditCardInfo;

class MainController extends Controller
{
    public function getIndex() {
    	$obj = new NavBarHelper();
    	$site_details = $obj->siteData();
    	return view('pages.index', compact('site_details'));
    }
    public function getLogin() {
    	$obj = new NavBarHelper();
    	$site_details = $obj->siteData();
    	return view('pages.login', compact('site_details'));
    }
    public function getSignUp(){
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        return view('pages.signup', compact('site_details'));
    }
    public function postSignUp(Request $request) {
        //dd($request);
        if ($request->password == $request->conf_password) {
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
                       return redirect()->route('getLogin')->with('success', 'You have successfully registered please login');
                       //mail should be send from here
                    }
                    else
                    {
                        return redirect()->route('getSignUp')->with('fail', 'Cannot save your card details');
                    }
                }
                else
                {
                    return redirect()->route('getSignUp')->with('fail', 'Cannot save your user details');
                }
            }
            else
            {
                return redirect()->route('getSignUp')->with('fail', 'Cannot save your user details');
            }
        }
        else
        {
            return redirect()->route('getSignUp')->with('fail', 'Password and confirm password did not match');
        }
    }
}
