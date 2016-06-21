<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function user_details() {
        return $this->hasOne('App\UserDetails', 'user_id', 'id');
    }
    public function card_details(){
    	return $this->hasOne('App\CustomerCreditCardInfo', 'user_id', 'id');
    }
}
