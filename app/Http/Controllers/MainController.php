<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Helper\NavBarHelper;
use App\User;
use App\UserDetails;
use App\PriceList;
use App\CustomerCreditCardInfo;
use Illuminate\Support\Facades\Auth;
use Mail;
use Hash;
use App\Neighborhood;
use App\Faq;
class MainController extends Controller
{
    public function getIndex() {
        //dd(1);
    	$obj = new NavBarHelper();
    	$site_details = $obj->siteData();
        $neighborhood = $obj->getNeighborhood();
        //dd($neighborhood);
    	return view('pages.index', compact('site_details', 'neighborhood'));
    }
    public function getLogin() {
        $user = auth()->guard('users');
    	$obj = new NavBarHelper();
    	$site_details = $obj->siteData();
        $neighborhood = $obj->getNeighborhood();
        if ($user->user()) {
            //return view('pages.userdashboard', compact('site_details'));
            return redirect()->route('getCustomerDahsboard');
        }
        else
        {
            return view('pages.login', compact('site_details', 'neighborhood'));
        }
    }
    public function getSignUp(){
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $neighborhood = $obj->getNeighborhood();
        return view('pages.signup', compact('site_details', 'neighborhood'));
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
                       //mail should be send from here
                        Mail::send('pages.sendEmail', array('name'=>$request->name,'email'=>$request->email,'password'=>$request->password), 
                        function($message) use($request)
                        {
                            $message->from('work@tier5.us');
                            $message->to($request->email, $request->name)->subject('U-rang Details');
                        });
                         return redirect()->route('getLogin')->with('success', 'You have successfully registered please login');
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
    public function postCustomerLogin(Request $request) {
        $email = $request->email;
        $password = $request->password;
        $remember_me = isset($request->remember)? true : false;
        $user = auth()->guard('users');
        $block_status = User::where('email', $email)->first();
        if ($block_status!=null) {
            if ($block_status->block_status == 0) {
                if ($user->attempt(['email' => $email, 'password' => $password], $remember_me)) {
                    return redirect()->route('getCustomerDahsboard');
                }
                else
                {
                   return redirect()->route('getLogin')->with('fail', 'Wrong Username or Password');
                }
            }
            else
            {
                return redirect()->route('getLogin')->with('fail', 'Sorry you are blocked by the system admin!');
            }
        }
        else
        {
             return redirect()->route('getLogin')->with('fail', 'Sorry! you have entered a wrong username');
        }
    }
    public function getDashboard() {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        //$user = auth()->guard('users');
        $logged_user = $obj->getCustomerData();
        $neighborhood = $obj->getNeighborhood();
        //dd($logged_user);
        return view('pages.userdashboard', compact('site_details', 'logged_user', 'neighborhood'));
    } 
    public function getLogout() {
        $user = auth()->guard('users');
        $user->logout();
        return redirect()->route('getLogin');
    }
    public function getProfile() {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $logged_user = $obj->getCustomerData();
        $neighborhood = $obj->getNeighborhood();
        return view('pages.profile', compact('site_details', 'logged_user', 'neighborhood'));
    }
    public function postProfile(Request $request) {
        $obj = new NavBarHelper();
        $logged_user = $obj->getCustomerData();
        $update_id = $logged_user->id;
        //dd($update_id);
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

                    return redirect()->route('get-user-profile')->with('success', 'Details successfully updated!');
                }
                else
                {
                   return redirect()->route('get-user-profile')->with('fail', 'Could not save your card details!'); 
                }
            }
            else
            {
                return redirect()->route('get-user-profile')->with('fail', 'Could not save user details!');
            }
        }
        else
        {
            return redirect()->route('get-user-profile')->with('fail', 'Could not save user details!');
        }
    }
    public function getChangePassword(){
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $logged_user = $obj->getCustomerData();
        $neighborhood = $obj->getNeighborhood();
        return view('pages.changepassword', compact('site_details', 'logged_user', 'neighborhood'));
    }
    public function postChangePassword(Request $request) {
        //dd($request);
        if ($request->new_password == $request->conf_password) {
            $id = auth()->guard('users')->user()->id;
            $old_password = $request->old_password;
            $new_password = $request->new_password;
            $user = User::find($id);
            if (Hash::check($old_password, $user->password)) {
                $user->password = bcrypt($new_password);
                if ($user->save()) {
                    return redirect()->route('getChangePassword')->with('success', "Password updated successfully!"); 
                }
                else
                {
                   return redirect()->route('getChangePassword')->with('fail', "Can't update your password right now please try again later"); 
                }
            }
            else
            {
                return redirect()->route('getChangePassword')->with('fail', 'old password did not match with our record');
            }
        }
        else
        {
            return redirect()->route('getChangePassword')->with('fail', 'Password and confirm password did not match!');
        }
    }
    public function getPrices() {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $login_check = $obj->getCustomerData();
        $neighborhood = $obj->getNeighborhood();
        //dd($login_check);
        $price_list = PriceList::with('categories')->get();
        //dd();
        if ($login_check != null) {
            //dd('i m here');
           $logged_user= $obj->getCustomerData();
           return view('pages.price', compact('site_details', 'login_check', 'logged_user' , 'price_list', 'neighborhood'));
        }
        else
        {
            return view('pages.price', compact('site_details', 'login_check' , 'price_list', 'neighborhood'));
        }
        
    }
    public function getNeiborhoodPage() {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $login_check = $obj->getCustomerData();
        $neighborhood = $obj->getNeighborhood();
        if ($login_check != null) {
            $logged_user= $obj->getCustomerData();
            return view('pages.neighborhood', compact('site_details', 'login_check' , 'price_list', 'neighborhood', 'logged_user'));
        } else {
            return view('pages.neighborhood', compact('site_details', 'login_check' , 'price_list', 'neighborhood'));
        }
    }
    public function getFaqList() {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $login_check = $obj->getCustomerData();
        $neighborhood = $obj->getNeighborhood();
        $faq = Faq::all();
        if ($login_check != null) {
            $logged_user= $obj->getCustomerData();
            return view('pages.faquser', compact('site_details', 'login_check' , 'price_list', 'neighborhood', 'logged_user', 'faq'));
        } else {
            return view('pages.faquser', compact('site_details', 'login_check' , 'price_list', 'neighborhood', 'faq'));
        }
    }
    public function emailChecker(Request $request) {
        //return $request->email;
        $email = $request->email;
        $find_email = User::where('email', $email)->first();
        //return $find_email;
        if ($find_email != null) {
           return 0;
        }
        else
        {
            return 1;
        }
    }

    public function getContactUs()
    {

        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        //$login_check = $obj->getCustomerData();
        $neighborhood = $obj->getNeighborhood();
        
        return view('pages.contact', compact('site_details', 'neighborhood'));
        
        //return view('pages.contact');
    }

    public function postContactForm(Request $request)
    {

            $flag=Mail::send('pages.sendEmailContact', array('firstName'=>$request->firstName,'lastName'=>$request->lastName,'email'=>$request->email,'subject'=>$request->subject,'message'=>$request->message,'phone'=>$request->phone), 
                        function($message) use($request)
                        {
                            $message->from($request->email);
                            $message->to('work@tier5.us', $request->name)->subject('U-rang Details');
                        });

            if($flag==1)
            {
                return redirect()->route('getContactUs')->with('success', 'Thank you for contacting us, We will get back to you shortly');
            }
            else
            {
                return redirect()->route('getContactUs')->with('fail', 'Mail is not sent');
            }

    }
}
