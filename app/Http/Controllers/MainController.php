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
use App\Pickupreq;
use App\OrderDetails;
use App\SchoolDonations;
use App\Cms;
class MainController extends Controller
{
    public function getIndex() {
        //dd(1);
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        //$neighborhood = $obj->getNeighborhood();
        //dd($neighborhood);
        return view('pages.index', compact('site_details'));
    }
    public function getLogin() {
        $user = auth()->guard('users');
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        //$neighborhood = $obj->getNeighborhood();
        if ($user->user()) {
            //return view('pages.userdashboard', compact('site_details'));
            return redirect()->route('getCustomerDahsboard');
        }
        else
        {
            return view('pages.login', compact('site_details'));
        }
    }
    public function getSignUp(){
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        //$neighborhood = $obj->getNeighborhood();
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
                        $this->sendAnEmail($request);
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
        $logged_user = $obj->getCustomerData();
        $pick_up_req = Pickupreq::where('user_id',$logged_user->id)->get();
        return view('pages.userdashboard', compact('site_details', 'logged_user', 'pick_up_req'));
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
        //$neighborhood = $obj->getNeighborhood();
        return view('pages.profile', compact('site_details', 'logged_user'));
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
        //$neighborhood = $obj->getNeighborhood();
        return view('pages.changepassword', compact('site_details', 'logged_user'));
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
        //$neighborhood = $obj->getNeighborhood();
        //dd($login_check);
        $price_list = PriceList::with('categories')->get();
        //dd();
        if ($login_check != null) {
            //dd('i m here');
           $logged_user= $obj->getCustomerData();
           return view('pages.price', compact('site_details', 'login_check', 'logged_user' , 'price_list'));
        }
        else
        {
            return view('pages.price', compact('site_details', 'login_check' , 'price_list'));
        }
        
    }
    public function getNeiborhoodPage() {
        //dd(1);
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $login_check = $obj->getCustomerData();
        $neighborhood = $obj->getNeighborhood();
        if ($login_check != null) {
            $logged_user= $obj->getCustomerData();
            return view('pages.neighborhood', compact('site_details', 'login_check' , 'price_list', 'logged_user', 'neighborhood'));
        } else {
            return view('pages.neighborhood', compact('site_details', 'login_check' , 'price_list', 'neighborhood'));
        }
    }
    public function getFaqList() {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $login_check = $obj->getCustomerData();
        //$neighborhood = $obj->getNeighborhood();
        $faq = Faq::all();
        if ($login_check != null) {
            $logged_user= $obj->getCustomerData();
            return view('pages.faquser', compact('site_details', 'login_check' , 'price_list','logged_user', 'faq'));
        } else {
            return view('pages.faquser', compact('site_details', 'login_check' , 'price_list','faq'));
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
        $login_check = $obj->getCustomerData();
        if ($login_check != null) {
            $logged_user= $obj->getCustomerData();
            return view('pages.contact', compact('site_details', 'login_check','logged_user'));
        }
        else
        {
            return view('pages.contact', compact('site_details', 'login_check'));
        }
    }

    public function postContactForm(Request $request)
    {
        //dd($request->message);
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
                            $msg->to('work@tier5.us', $request->firstName)->subject('U-rang Details');
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
    public function getPickUpReq() {
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        return view('pages.pickupreq', compact('site_details'));
    }
    public function postPickUp (Request $request) {
        //dd($request);
        $total_price = 0.00;
        $pick_up_req = new Pickupreq();
        $pick_up_req->user_id = auth()->guard('users')->user()->id;
        $pick_up_req->address = $request->address;
        $pick_up_req->pick_up_date = date("Y-m-d", strtotime($request->pick_up_date));
        $pick_up_req->pick_up_type = $request->order_type == 1 ? 1 : 0;
        $pick_up_req->schedule = $request->schedule;
        $pick_up_req->delivary_type = $request->boxed_or_hung;
        $pick_up_req->starch_type = $request->strach_type;
        $pick_up_req->need_bag = isset($request->urang_bag) ? 1 : 0;
        $pick_up_req->door_man = $request->doorman;
        $pick_up_req->special_instructions = isset($request->spcl_ins) ? $request->spcl_ins: null;
        $pick_up_req->driving_instructions = isset($request->driving_ins) ? $request->driving_ins : null;
        $pick_up_req->payment_type = $request->pay_method;
        $pick_up_req->order_status = 1;
        $pick_up_req->is_emergency = isset($request->isEmergency) ? 1 : 0;
        $pick_up_req->client_type = $request->client_type;
        $pick_up_req->coupon = NULL;
        $pick_up_req->wash_n_fold = $request->wash_n_fold;
        if(isset($request->school_donation_id))
        {
            $pick_up_req->school_donation_id = $request->school_donation_id;
            $pick_up_req->school_donation_amount = $request->school_donation_amount;
            $search = SchoolDonations::find($request->school_donation_id);
            $present_pending_money = $search->pending_money;
            $updated_pending_money = $present_pending_money+$request->school_donation_amount;
            $search->pending_money = $updated_pending_money;
            $search->save();

        }
        $data_table = json_decode($request->list_items_json);
        for ($i=0; $i< count($data_table); $i++) {
            $total_price += $data_table[$i]->item_price*$data_table[$i]->number_of_item;
        }
        $pick_up_req->total_price = $request->order_type == 1 ? 0.00 : $total_price;
        if ($pick_up_req->save()) {
            if ($request->order_type == 1) {
                //fast pick up
                return redirect()->route('getPickUpReq')->with('success', "Thank You! for submitting the order we will get back to you shortly!");
            }
            else
            {
                //detailed pick up
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
                return redirect()->route('getPickUpReq')->with('success', "Thank You! for submitting the order we will get back to you shortly!");
            }
        }
        else
        {
            return redirect()->route('getPickUpReq')->with('fail', "Could Not Save Your Details Now!");
        }
    }
    public function getMyPickUps() {
        $pick_up_req = Pickupreq::where('user_id',auth()->guard('users')->user()->id)->with('order_detail')->orderBy('created_at','desc')->get();
        //dd($pick_up_req);
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        return view('pages.mypickups', compact('pick_up_req', 'site_details'));
    }
    public function postDeletePickUp(Request $request) {
        $id_to_del = $request->id;
        $search = Pickupreq::find($id_to_del);
        if ($search) {
           if ($search->pick_up_type == 0) {
                $search->delete();
                $search_order_details = OrderDetails::where('pick_up_req_id', $id_to_del)->get();
                foreach ($search_order_details as $details) {
                    $details->delete();
                }
                return 1;
           }
           else
           {
                if ($search->delete()) {
                    return 1;
                }
                else
                {
                    return 0;
                }
           }
        }
        else
        {
           return 0; 
        }
    }
    private function sendAnEmail($request) {
        //mail should be send from here
        //dd($request->email);
        Mail::send('pages.sendEmail', array('name'=>$request->name,'email'=>$request->email,'password'=>$request->password), 
        function($message) use($request)
        {
            $message->from('work@tier5.us');
            $message->to($request->email, $request->name)->subject('U-rang Details');
        });
    }
    public function getSchoolDonations(){
        $obj = new NavBarHelper();
        $site_details = $obj->siteData();
        $login_check = $obj->getCustomerData();
        $list_school = SchoolDonations::with('neighborhood')->get();
        //dd($list_school);
        if ($login_check != null) {
            $logged_user= $obj->getCustomerData();
            return view('pages.school-donation', compact('site_details', 'login_check','logged_user', 'list_school'));
        }
        else
        {
            return view('pages.school-donation', compact('site_details', 'login_check', 'list_school'));
        }
    }
    public function getDryClean() {
        $obj = new NavBarHelper();
        $login_check = $obj->getCustomerData();
        $page_data = Cms::where('identifier', 0)->first();
        return view('stand_alone_pages.dryclean', compact('login_check', 'page_data'));
    }
}
