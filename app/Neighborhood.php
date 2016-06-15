<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Neighborhood extends Model
{
    public function admin() {
    	return $this->hasMany('App\Admin', 'id', 'admin_id');
    }
}
