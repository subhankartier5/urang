<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin =new Admin();
        $admin->username = "Jon Vaughn";
        $admin->email = "jonvaughn@urang.com";
        $admin->password = bcrypt('123456');
        $admin->save();
    }
}
