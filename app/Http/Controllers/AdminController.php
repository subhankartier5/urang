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
        $site_details = $obj->siteData();
    	return view('admin.dashboard', compact('user_data', 'site_details'));
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
        $name = $request->name;
        $description = $request->description;
        $admin_id = Auth::user()->id;
        $data = new Neighborhood();
        $data->admin_id = $admin_id;
        $data->name = $name;
        $data->description = $description;
        if ($data->save()) {
           return 1;
        }
        else
        {
            return 0;
        }
    }
    public function editNeighborhood(Request $request) {
        $search = Neighborhood::find($request->id);
        if ($search) {
            $search->name = $request->name;
            $search->description = $request->description;
            if ($search->save()) {
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
}
