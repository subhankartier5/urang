<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    public function categories() {
    	return $this->hasOne('App\Categories', 'id', 'category_id');
    }
    public function admin() {
    	return $this->hasOne('App\Admin', 'id', 'admin_id');
    }
}
