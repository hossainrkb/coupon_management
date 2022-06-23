<?php

namespace Interview\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Interview\Backend\Models\Category;
use Interview\Backend\Models\Course;

class AppliedableCouponController extends Controller
{
    public function appliedCouponOnCategory(Request $request,Category $category){
        $category->appliedcoupons()->create([
            'coupon_id'=> $request->coupon_id
        ]);
        return response()->json([
            'status' => 'ok',
            'message' => 'Coupon Successfully Applied on Category'
        ]);
    }
    public function appliedCouponOnCourse(Request $request,Course $course){
        $course->appliedcoupons()->create([
            'coupon_id'=> $request->coupon_id
        ]);
        return response()->json([
            'status' => 'ok',
            'message' => 'Coupon Successfully Applied on Course'
        ]);
    }
}
