<?php

namespace Interview\Backend\Http\Controllers;

use App\Http\Controllers\Controller;
use Interview\Backend\Models\Course;
use Interview\Backend\Http\Resources\CourseCollection;

class CourseController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'ok',
            'data' => new CourseCollection(Course::all())
        ]); 
    }
}
