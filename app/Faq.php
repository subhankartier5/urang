<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    public function admin_details() {
    	return $this->hasOne('App\Admin', 'id', 'admin_id');
    }
}
