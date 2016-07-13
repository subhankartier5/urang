<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function user(){
    	return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function user_details(){
    	return $this->hasOne('App\UserDetails', 'user_id', 'user_id');
    }
    public function pick_up_req() {
    	return $this->hasOne('App\Pickupreq', 'id', 'pick_up_req_id');
    }
}
