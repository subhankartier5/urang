<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolDonations extends Model
{
    public function neighborhood(){
    	return $this->hasOne('App\Neighborhood', 'id' , 'neighborhood_id');
    }
}
