<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolPreferences extends Model
{
    public function schoolDonation(){
    	return $this->hasOne('App\SchoolDonations', 'id' , 'school_id');
    }
}
