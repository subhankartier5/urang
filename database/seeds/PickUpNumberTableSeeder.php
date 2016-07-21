<?php

use Illuminate\Database\Seeder;
use App\PickUpNumber;
class PickUpNumberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	if(!PickUpNumber::first())
    	{
    		$staff = new \App\PickUpNumber();
	        $staff->week_day = 10;
	        $staff->saturday = 5;
	        $staff->sunday = 0;
	        $staff->save();
    	}
        
    }
}
