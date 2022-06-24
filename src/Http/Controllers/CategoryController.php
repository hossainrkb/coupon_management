<?php

namespace Interview\Backend\Http\Controllers;

use App\Http\Controllers\Controller;
use Interview\Backend\Http\Resources\CategoryCollection;
use Interview\Backend\Http\Resources\CategoryPreview;
use Interview\Backend\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'ok',
            'data' => new CategoryCollection(Category::all())
        ]); 
    }
    public function show(Category $category)
    {
        return response()->json([
            'status' => 'ok',
            'data' => new CategoryPreview($category)
        ]); 
    }
}
