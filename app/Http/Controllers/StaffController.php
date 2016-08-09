<?php

namespace App\Http\Controllers;
use App\Helper\NavBarHelper;
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
use App\SchoolDonations;
use App\Neighborhood;
use App\PaymentKeys;
use App\Invoice;
use App\SchoolDonationPercentage;
use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;
use App\CustomerCreditCardInfo;
use App\Http\Controllers\AdminController;
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
            $pickups = Pickupreq::orderBy('id', 'desc')->with('user_detail','user','order_detail', 'invoice')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
            return view('staff.orders',compact('pickups'));
        }
        else
        {
            return redirect()->route('getStaffLogin');
        }
        
    }
    private function ChargeCard($id, $amount) {
        //fetch the record from databse
        $merchantAuthentication = new AnetAPI\MerchantAuthenticationType();
        $customer_credit_card = CustomerCreditCardInfo::where('user_id', $id)->first();
        $payment_keys = PaymentKeys::first();
        if ($payment_keys != null) {
            $merchantAuthentication->setName($payment_keys->login_id);
            $merchantAuthentication->setTransactionKey($payment_keys->transaction_key);
            // Create the payment data for a credit card
            $creditCard = new AnetAPI\CreditCardType();
            $creditCard->setCardNumber($customer_credit_card->card_no);
            $creditCard->setExpirationDate("20".$customer_credit_card->exp_year."-".$customer_credit_card->exp_month);
            $paymentOne = new AnetAPI\PaymentType();
            $paymentOne->setCreditCard($creditCard);
            $transactionRequestType = new AnetAPI\TransactionRequestType();
            $transactionRequestType->setTransactionType( "authCaptureTransaction"); 
            $transactionRequestType->setAmount($amount);
            $transactionRequestType->setPayment($paymentOne);
            $request = new AnetAPI\CreateTransactionRequest();
            $request->setMerchantAuthentication($merchantAuthentication);
            $request->setTransactionRequest( $transactionRequestType);
            $controller = new AnetController\CreateTransactionController($request);
            if ($payment_keys->mode == 1) {
                $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::PRODUCTION);
            }
            else
            {
                $response = $controller->executeWithApiResponse( \net\authorize\api\constants\ANetEnvironment::SANDBOX);
            }
            //dd($response);
            if ($response != null) {
                $tresponse = $response->getTransactionResponse();
                if (($tresponse != null) && ($tresponse->getResponseCode()=="1") )   
                {
                    return "I00001";
                }
                else
                {
                    return 2;
                }
            } 
            else
            {
                return 1;
            }
        } 
        else 
        {
            return 0;
        }
    }
    public function changeOrderStatus(Request $req)
    {
        //dd($req);
        $staff = auth()->guard('staffs')->user();
        if($staff)
        {
            /*//dd($req);
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
            }*/
            $total_price = isset($req->total_price)? $req->total_price : false;
            if($total_price)
            {
                $data['order_status'] = $req->order_status;
                $data['total_price'] = $total_price;
                if ($req->order_status == 4 && $req->payment_type == 1) {
                    $response = $this->ChargeCard($req->user_id, $req->chargable);
                    //dd($response);
                    if ($response == "I00001") {
                        $data['payment_status'] = 1;
                    }
                    else
                    {
                        Session::put("error_code", $response);
                    }
                }
                $result = Pickupreq::where('id', $req->pickup_id)->update($data);
                if($result)
                {
                    (new AdminController)->TrackOrder($req);
                    return redirect()->route('getStaffOrders')->with('success', 'Order Status successfully updated!');
                }
                else
                {
                    return redirect()->route('getStaffOrders')->with('error', 'Failed to update Order Status!');
                }
            }
            else
            {
                $data['order_status'] = $req->order_status;
                if ($req->order_status == 4 && $req->payment_type == 1) {
                    $response = $this->ChargeCard($req->user_id, $req->chargable);
                    //dd($response);
                    if ($response == "I00001") {
                        $data['payment_status'] = 1;
                    } 
                    else
                    {
                        Session::put("error_code", $response);
                    }
                }
                //dd($data);
                $result = Pickupreq::where('id', $req->pickup_id)->update($data);
                if($result)
                {
                    (new AdminController)->TrackOrder($req);
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
        //$obj = new NavBarHelper();
        //$user_data = $obj->getUserData();
        //$site_details = $obj->siteData();
        $input = Input::get('sort');
        $sort = isset($input) ? $input : false;

        if($sort)
        {
            if ($sort == 'paid') {
                $pickups = Pickupreq::where('payment_status', 1)->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
                $donate_money_percentage = SchoolDonationPercentage::first();
                return view('staff.orders',compact('pickups','user_data', 'donate_money_percentage'));
            } else if($sort == 'unpaid') {
                $pickups = Pickupreq::where('payment_status', 0)->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
                $donate_money_percentage = SchoolDonationPercentage::first();
                return view('staff.orders',compact('pickups','user_data', 'donate_money_percentage'));
            } else {
                $pickups = Pickupreq::orderBy($sort,'desc')->with('user_detail','user','order_detail')->paginate((new \App\Helper\ConstantsHelper)->getPagination());
                $donate_money_percentage = SchoolDonationPercentage::first();
                return view('staff.orders',compact('pickups','user_data', 'donate_money_percentage'));
            }
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
        for ($j=0; $j< count($data); $j++) 
        {
            $invoice = new Invoice();
            $invoice->pick_up_req_id = $request->row_id;
            $invoice->user_id = $request->row_user_id;
            $invoice->invoice_id = $request->invoice_updt;
            $invoice->price = $data[$j]->item_price;
            $invoice->item = $data[$j]->item_name;
            $invoice->quantity = $data[$j]->number_of_item;
            $invoice->save();
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

    public function getSchoolDonationStaff() {
       $staff = auth()->guard('staffs')->user();
       if ($staff) {
            $list_school = SchoolDonations::with('neighborhood')->paginate(10);
            $neighborhood = Neighborhood::all();
            return view('staff.school-donation', compact('list_school', 'neighborhood'));
       }
       else
       {
        return redirect()->route('getStaffLogin');
       }
    }
    public function postEditSchoolStaff(Request $request) {
        //dd($request);
        $search = SchoolDonations::find($request->sch_id);
        if ($search) {
            $search->neighborhood_id = $request->neighborhood;
            $search->school_name = $request->school_name;
            if ($request->image) {
                $image = $request->image;
                $extension =$image->getClientOriginalExtension();
                $destinationPath = 'public/dump_images/';
                $fileName = rand(111111111,999999999).'.'.$extension;
                $image->move($destinationPath, $fileName);
                $search->image = $fileName;
            }
            $search->pending_money = $request->pending_money;
            $search->total_money_gained = $request->total_money_gained;
            if ($search->save()) {
                return redirect()->route('getSchoolDonationStaff')->with('success', 'Successfully Saved School !');
            }
            else
            {
                return redirect()->route('getSchoolDonationStaff')->with('fail', 'Failed to update some error occured !');
            }
        }
        else
        {
            return redirect()->route('getSchoolDonationStaff')->with('fail', 'Failed to find a School !');
        }
    }
    public function postDeleteSchoolStaff(Request $request) {
        $search_school = SchoolDonations::find($request->id);
        if ($search_school) {
            if ($search_school->delete()) {
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
    public function postPendingMoneyStaff(Request $request) {
        $search_school = SchoolDonations::find($request->id);
        if ($search_school) {
            $total_money_gained = $search_school->total_money_gained;
            $pending_money = $search_school->pending_money;
            //return 1;
            $search_school->total_money_gained = $total_money_gained+$pending_money;
            $search_school->pending_money = 0.00;
            if ($search_school->save()) {
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
    public function getMakePayments() {
        $staff = auth()->guard('staffs')->user();
        if ($staff) {
            $payment_keys = PaymentKeys::first();
            $user_details = Pickupreq::where('payment_type',1)->where('payment_status', 0)->with('user')->get();
            return view('staff.make-payment', compact('user_data', 'payment_keys', 'user_details', 'site_details'));
        }
        else
        {
            return redirect()->route('getStaffLogin');
        }
    }
    public function getManualPayment() {
       $staff = auth()->guard('staffs')->user();
        if ($staff) {
            $data = Pickupreq::where('payment_status', 0)->where('payment_type', '!=', 1)->with('user')->paginate(10);
            return view('staff.manual_payment', compact('data'));
        }
        else
        {
            return redirect()->route('getStaffLogin');
        }
    }
}
