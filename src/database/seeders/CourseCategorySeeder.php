<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Interview\Backend\Models\Category;
use Interview\Backend\Models\Course;
use Interview\Backend\Models\CourseCategory;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories  = Category::all();
        $courses  = Course::all();
        $courses = $courses->chunk(3);
        foreach ($categories as $key => $value) {
            if ($key == 3) {
                break;
            }
            $coursesTwo = $courses[$key];
            if(isset($coursesTwo)){
                foreach ($coursesTwo as $key => $eachCourse) {
                    CourseCategory::create([
                        'course_id'=>$eachCourse->id,
                        'category_id'=>$value->id,
                    ]);
                }
            }
        }
    }
}
