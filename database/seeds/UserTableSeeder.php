<?php

use Illuminate\Database\Seeder;
use App\User;
use App\UserDetails;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->email = 'andy@gmail.com';
        $user->password = bcrypt('123456');
        if ($user->save()) {
        	$user_details = new UserDetails();
        	$user_details->user_id = $user->id;
        	$user_details->name = "Andy Anderson";
        	$user_details->address = "Ny 10023";
        	$user_details->personal_ph = "84444522";
        	$user_details->spcl_instructions = "do it fast its urgent";
        	$user_details->payment_status = 0;
        	$user_details->save();

        }
    }
}
