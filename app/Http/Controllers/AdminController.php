<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Redirect;
use App\Helper\NavBarHelper;
use Hash;
use App\Admin;
use App\SiteConfig;
use App\Neighborhood;
use App\Categories;
use App\PriceList;
use DB;
use App\User;
use App\UserDetails;
use App\CustomerCreditCardInfo;
use App\Faq;

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
        //protected $guard = {'admin'};
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
        $site_details = $obj->siteData();
        $customers = User::with('user_details', 'pickup_req', 'order_details')->paginate(10);
    	return view('admin.dashboard', compact('user_data', 'site_details', 'customers'));
    }
    public function logout() {
    	Auth::logout();
    	return redirect()->route('get-admin-login');
    }
    public function getProfile() {
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();
        return view('admin.admin-profile', compact('user_data', 'site_details'));
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
    public function getSettings() {
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = SiteConfig::first();
        return view('admin.settings', compact('user_data', 'site_details'));
    }
    public function postChangePassword(Request $request) {
        $id = Auth::user()->id;
        $password = $request->c_pass;
        $updated_password = $request->confirm_password;
        $search = Admin::find($id);
        if ($search) {
            if (Hash::check($password, $search->password)) {
                //echo "do update";
               $search->password = bcrypt($updated_password);
               if ($search->save()) {
                   return redirect()->route('get-admin-settings')->with('success', 'password successfully updated');
                }
                else
                {
                    return redirect()->route('get-admin-settings')->with('error', 'Cannot update your password right now tray again later');
                }
            }
            else
            {
                return redirect()->route('get-admin-settings')->with('error', 'Password did not match with our record');
            }
        }
        else
        {
            return redirect()->route('get-admin-settings')->with('error', 'Could not find your details try again later');
        }
    }
    public function postSiteSettings(Request $request) {
        $site_config = SiteConfig::first();
        if ($site_config) {
            $site_config->site_title = $request->title;
            $site_config->site_url = $request->url;
            $site_config->site_email = $request->email;
            $site_config->meta_keywords = rtrim($request->metakey);
            $site_config->meta_description = rtrim($request->metades);
            if ($site_config->save()) {
               return redirect()->route('get-admin-settings')->with('success', 'site settings successfully updated');
            }
            else
            {
                return redirect()->route('get-admin-settings')->with('error', 'Could not set up site settings');
            }
        }
        else
        {
            $site_config = new SiteConfig();
            $site_config->site_title = $request->title;
            $site_config->site_url = $request->url;
            $site_config->site_email = $request->email;
            $site_config->meta_keywords = rtrim($request->metakey);
            $site_config->meta_description = rtrim($request->metades);
            if ($site_config->save()) {
                return redirect()->route('get-admin-settings')->with('success', 'site settings successfully updated');
            }
            else
            {
                return redirect()->route('get-admin-settings')->with('error', 'Could not set up site settings');
            }
        }
        
    }
    public function getNeighborhood() {
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();
        $neighborhood = Neighborhood::with('admin')->paginate(10);  
        //dd($neighborhood);
        return view('admin.neighborhood', compact('user_data', 'site_details', 'neighborhood'));
    }
    public function postNeighborhood(Request $request) {
        //dd($request->image);
        $name = $request->name;
        $description = $request->description;
        $admin_id = Auth::user()->id;
        $image = $request->image;
        $extension =$image->getClientOriginalExtension();
        $destinationPath = 'public/dump_images/';   // upload path
        $fileName = rand(111111111,999999999).'.'.$extension; // renameing image
        $image->move($destinationPath, $fileName); // uploading file to given path 
        //return $fileName;
        $data = new Neighborhood();
        $data->admin_id = $admin_id;
        $data->name = $name;
        $data->description = $description;
        $data->image = $fileName;
        if ($data->save()) {
           //return 1;
            return redirect()->route('get-neighborhood')->with('success', 'Neighborhood added Successfully');
        }
        else
        {
            //return 0;
            return redirect()->route('get-neighborhood')->with('fail', 'Failed to add neighborhood');
        }
    }
    public function editNeighborhood(Request $request) {
        //dd($request);
        $search = Neighborhood::find($request->id);
        if ($search) {
            $search->name = $request->nameEdit;
            $search->description = $request->descriptionEdit;
            if ($request->image) {
                $image = $request->image;
                $extension =$image->getClientOriginalExtension();
                $destinationPath = 'public/dump_images/';   // upload path
                $fileName = rand(111111111,999999999).'.'.$extension; // renameing image
                $image->move($destinationPath, $fileName); // uploading file to given path 
                //return $fileName;
                $search->image = $fileName;
            }
            if ($search->save()) {
                return redirect()->route('get-neighborhood')->with('success', 'Neighborhood updated Successfully');
            }
            else
            {
                return redirect()->route('get-neighborhood')->with('fail', 'Failed to update neighborhood');
            }
        }
        else
        {
            return redirect()->route('get-neighborhood')->with('fail', 'Failed to update neighborhood');
        }
    }
    public function deleteNeighborhood(Request $request) {
        //return $request->id;
        $search = Neighborhood::find($request->id);
        if ($search) {
            if ($search->delete()) {
               return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }
    public function getPriceList() {
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();
        $priceList = PriceList::with('categories', 'admin')->paginate(10);
        $categories = Categories::all();
        //dd(count($categories));
        return view('admin.priceList', compact('user_data', 'site_details', 'priceList', 'categories'));
    }
    public function postPriceList(Request $request){
        $item = new PriceList();
        $item->admin_id = Auth::user()->id;
        $item->category_id = $request->category;
        $item->item = $request->item;
        $item->price = $request->price;
        if ($item->save()) {
            $return = PriceList::with('categories', 'admin')->get();
            return $return;
        }
        else
        {
            return 0;
        }
        
    }
    public function editPriceList(Request $request) {
        //return 0;
        $search = PriceList::find($request->id);
        if ($search) {
            $search->item = $request->name;
            $search->price = $request->price;
            if ($search->save()) {
                //$return =  PriceList::with('categories', 'admin')->get();
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }
    public function postDeleteItem(Request $request) {
        $search = PriceList::find($request->id);
        if ($search) {
            if ($search->delete()) {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }
    public function postCategory(Request $request) {
        $category = new Categories();
        $category->name = $request->name;
        if ($category->save()) {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    public function postDeleteCategory(Request $request) {
        $search = Categories::find($request->id);
        if ($search) {
            if ($search->delete()) {
                return 1;
            }
            else
            {
                return 0;
            }
            
        }
        else
        {
            return 0;
        }
    }
    public function getCustomers(){
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();
        $customers = User::with('user_details')->paginate(10);
        return view('admin.customers', compact('user_data', 'site_details', 'customers'));
    }
    public function getEditCustomer($id) {
        $id = base64_decode($id);
        $user = User::where('id', $id)->with('user_details', 'card_details')->first();
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();
        return view('admin.EditCustomers', compact('user_data', 'site_details', 'user'));
    }
    public function postBlockCustomer(Request $request) {
        $id = $request->id;
        $user = User::find($id);
        if ($user && $user->block_status == 0) {
            $user->block_status = 1;
            if ($user->save()) {
               return 1;
            }
            else
            {
                return 0;
            }
        }
        elseif($user && $user->block_status == 1)
        {
            $user->block_status = 0;
            if ($user->save()) {
               return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }
    public function DeleteCustomer(Request $request) {
        $id = $request->id;
        $user = User::find($id);
        if ($user) {
            if ($user->delete()) {
                $user_details = UserDetails::where('user_id', $id)->first();
                $user_details->delete();
                $card_details = CustomerCreditCardInfo::where('user_id', $id)->first();
                if ($card_details) {
                    $card_details->delete();
                    return 1;
                }
                else
                {
                    return 0;
                }
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 0;
        }
    }
    public function postEditCustomer(Request $request) {
        //dd($request);
        $search = User::find($request->id);
        if ($search) {
            $search->email = $request->email;
            if ($search->save()) {
                $searchUserDetails = UserDetails::where('user_id', $request->id)->first();
                if ($searchUserDetails) {
                    $searchUserDetails->name = $request->name;
                    $searchUserDetails->address = $request->address;
                    $searchUserDetails->personal_ph = $request->pph_no;
                    $searchUserDetails->cell_phone = isset($request->cph_no) ? $request->cph_no : NULL;
                    $searchUserDetails->off_phone = isset($request->oph_no) ? $request->oph_no : NULL;
                    $searchUserDetails->spcl_instructions = isset($request->spcl_instruction) ? $request->spcl_instruction : NULL;
                    $searchUserDetails->driving_instructions = isset($request->driving_instructions) ? $request->driving_instructions : NULL;
                    if ($searchUserDetails->save()) {
                       $credit_info = CustomerCreditCardInfo::where('user_id', $request->id)->first();
                       if ($credit_info) {
                          $credit_info->name = $request->card_name;
                          $credit_info->card_no = $request->card_no;
                          $credit_info->cvv = isset($request->cvv) ? $request->cvv : NULL;
                          $credit_info->card_type = $request->cardType;
                          $credit_info->exp_month = $request->SelectMonth;
                          $credit_info->exp_year = $request->selectYear;
                          if ($credit_info->save()) {
                             return redirect()->route('getAllCustomers')->with('successUpdate', 'Records Updated Successfully!');
                          }
                          else
                          {
                            return redirect()->route('getAllCustomers')->with('fail', 'Could Not find a customer to update details');
                          }
                       }
                       else
                       {
                        return redirect()->route('getAllCustomers')->with('fail', 'Could Not find a customer to update details');
                       }
                    }
                    else
                    {
                        return redirect()->route('getAllCustomers')->with('fail', 'Could Not find a customer to update details');
                    }
                }
                else
                {
                    return redirect()->route('getAllCustomers')->with('fail', 'Could Not find a customer to update details');
                }
            }
            else
            {
                return redirect()->route('getAllCustomers')->with('fail', 'Could Not find a customer to update details');
            }
        }
        else
        {
            return redirect()->route('getAllCustomers')->with('fail', 'Could Not find a customer to update details');
        }
    }
    public function getAddNewCustomer(){
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();
        return view('admin.addnewcustomer', compact('user_data', 'site_details'));
    }
    public function postAddNewCustomer(Request $request) {
        //dd($request);
        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->conf_password);
        $user->block_status = 0;
        if ($user->save()) {
            $user_details = new UserDetails();
            $user_details->user_id = $user->id;
            $user_details->name = $request->name;
            $user_details->address = $request->address;
            $user_details->personal_ph = $request->personal_ph;
            $user_details->cell_phone = isset($request->cellph_no) ? $request->cellph_no : NULL;
            $user_details->off_phone = isset($request->officeph_no) ? $request->officeph_no : NULL;
            $user_details->off_phone = isset($request->officeph_no) ? $request->officeph_no : NULL;
            $user_details->spcl_instructions = isset($request->spcl_instruction) ? $request->spcl_instruction : NULL;
            $user_details->driving_instructions = isset($request->driving_instructions) ? $request->driving_instructions : NULL;
            $user_details->payment_status = 0;
            if ($user_details->save()) {
                $credit_info = new CustomerCreditCardInfo();
                $credit_info->user_id = $user_details->user_id;
                $credit_info->name = $request->card_name;
                $credit_info->card_no = $request->card_no;
                $credit_info->card_type = $request->cardType;
                $credit_info->cvv = isset($request->cvv) ? $request->cvv : NULL;
                $credit_info->exp_month = $request->SelectMonth;
                $credit_info->exp_year = $request->selectYear;
                if ($credit_info->save()) {
                    return redirect()->route('getAddNewCustomers')->with('success', 'Records saved successfully');
                }
                else
                {
                    return redirect()->route('getAddNewCustomers')->with('fail', 'Could Not save your details');
                }
            }
            else
            {
               return redirect()->route('getAddNewCustomers')->with('fail', 'Could Not save your details');
            }
        }
        else
        {
            return redirect()->route('getAddNewCustomers')->with('fail', 'Could Not save your details');
        }
    }
    public function getFaq() {
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = $obj->siteData();
        $faq = Faq::with('admin_details')->paginate(10);
        //dd($faq);
        return view('admin.faq', compact('user_data', 'site_details', 'faq'));
    }
    public function postAddFaq(Request $request) {
        $admin_id = Auth::user()->id;
        $question = $request->question;
        $answer = $request->answer;
        $image = $request->image;
        $extension =$image->getClientOriginalExtension();
        $destinationPath = 'public/dump_images/';   // upload path
        $fileName = rand(111111111,999999999).'.'.$extension; // renameing image
        $image->move($destinationPath, $fileName); // uploading file to given path 
        //return $fileName;
        $faq = new Faq();
        $faq->question = $question;
        $faq->answer = $answer;
        $faq->image = $fileName;
        $faq->admin_id = $admin_id;
        if ($faq->save()) {
            return redirect()->route('getFaq')->with('successUpdate', 'Faq Successfully added!');
        }
        else
        {
            return redirect()->route('getFaq')->with('fail', 'Cannot Add faq try again later!');
        }
    }
    public function UpdateFaq(Request $request) {
        //dd($request);
        //return $request;
        $id = $request->id;
        $question =$request->questionEdit;
        $answer = $request->answerEdit;
        if ($request->image != null) {
            $image = $request->image;
            $extension =$image->getClientOriginalExtension();
            $destinationPath = 'public/dump_images/';   // upload path
            $fileName = rand(111111111,999999999).'.'.$extension; // renameing image
            $image->move($destinationPath, $fileName); // uploading file to given path 
            //return $fileName;
        }
        else
        {
            //dd('im here');
            $data = Faq::find($id);
            $fileName = $data->image;
        }
        $faq = Faq::find($id);
        if ($faq) {
            $faq->question = $question;
            $faq->answer = $answer;
            $faq->image = $fileName;
            $faq->admin_id = Auth::user()->id;
            if ($faq->save()) {
                return redirect()->route('getFaq')->with('successUpdate', 'Faq Successfully Updated!');
            }
            else
            {
                return redirect()->route('getFaq')->with('fail', 'Cannot Upadte faq try again later!');
            }
        }
        else
        {
            return redirect()->route('getFaq')->with('fail', 'Cannot Update faq try again later!');
        }
    }
    public function DeleteFaq(Request $request) {
        $id = $request->id;
        $faq = Faq::find($id);
        if ($faq) {
           if ($faq->delete()) {
               return 1;
           }
           else
           {
                return 0;
           }
        }
        else
        {
            return 0;
        }
    }
    public function getCustomerOrders() {
        $obj = new NavBarHelper();
        $user_data = $obj->getUserData();
        $site_details = SiteConfig::first();
        return view('admin.customerorders', compact('user_data', 'site_details'));
    }
}
