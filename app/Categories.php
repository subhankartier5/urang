<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function pricelists()
    {
    	return $this->hasMany('App\PriceList','category_id','id');
    }
}
