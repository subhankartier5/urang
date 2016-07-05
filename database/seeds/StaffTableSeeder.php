<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff = new \App\Staff();
        $staff->user_name = "test@abc.com";
        $staff->password = bcrypt('123456');
        $staff->active = 1;
        $staff->save();
    }
}
