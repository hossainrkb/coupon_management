<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Interview\Backend\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        for ($i=0; $i <10 ; $i++) { 
            Category::create([
                'name'=> substr($faker->address,0,12)
            ]);
        }
    }
}
