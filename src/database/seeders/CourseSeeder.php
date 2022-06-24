<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Interview\Backend\Models\Course;

class CourseSeeder extends Seeder
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
            $price = $faker->randomElement([500.25,1000,562.24,452.2,458.36,85.25]);
            Course::create([
                'name'=> substr($faker->name,0,15),
                'price' => $price
            ]);
        }
    }
}
