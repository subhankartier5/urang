<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class User extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
	use Authenticatable;
    public function user_details() {
        return $this->hasOne('App\UserDetails', 'user_id', 'id');
    }
    public function card_details(){
    	return $this->hasOne('App\CustomerCreditCardInfo', 'user_id', 'id');
    }
    public function pickup_req()
    {
    	return $this->hasMany('App\Pickupreq','user_id','id');
    }
    public function order_details() {
        return $this->hasMany('App\OrderDetails', 'user_id', 'id');
    }
}
