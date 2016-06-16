<?php

use Illuminate\Database\Seeder;
use App\Categories;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Categories();
        $category->name = "Residential Services";
        $category->save();
        $category = new Categories();
        $category->name = "Household Items: Dry Clean";
        $category->save();
        $category = new Categories();
        $category->name = "Bedding";
        $category->save();
    }
}
