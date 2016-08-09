<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pickupreq extends Model
{

    public function user_detail()
    {
    	return $this->hasOne('App\UserDetails','user_id','user_id');
    }
    public function user()
    {
    	return $this->hasOne('App\User','id','user_id');
    }
    public function order_detail()
    {
    	return $this->hasMany('App\OrderDetails','pick_up_req_id','id');
    }
    public function invoice() {
        return $this->hasMany('App\Invoice', 'pick_up_req_id', 'id');
    }
    public function school_donations() {
        return $this->hasOne('App\SchoolDonations', 'id', 'school_donation_id');
    }
    public function OrderTrack() {
        return $this->hasOne('App\OrderTracker', 'pick_up_req_id', 'id');
    }
}
