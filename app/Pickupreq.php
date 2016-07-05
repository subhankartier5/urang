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
}
