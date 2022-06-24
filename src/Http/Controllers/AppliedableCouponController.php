<?php

namespace Interview\Backend\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Interview\Backend\Models\AppliedableCoupon;
use Interview\Backend\Models\Category;
use Interview\Backend\Models\Course;

class AppliedableCouponController extends Controller
{
    public function appliedCouponOnCategory(Request $request,Category $category){
        if(count($category->appliedcoupons)){
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon Already Applied to This Category'
            ]);
        }
        $category->appliedcoupons()->create([
            'coupon_id'=> $request->coupon_id
        ]);
        return response()->json([
            'status' => 'ok',
            'message' => 'Coupon Successfully Applied on Category'
        ]);
    }
    public function appliedCouponOnCourse(Request $request,Course $course){
        if(count($course->appliedcoupons)){
            return response()->json([
                'status' => 'error',
                'message' => 'Coupon Already Applied to This Course'
            ]);
        }
        $course->appliedcoupons()->create([
            'coupon_id'=> $request->coupon_id
        ]);
        return response()->json([
            'status' => 'ok',
            'message' => 'Coupon Successfully Applied on Course'
        ]);
    }

    public function destroy(AppliedableCoupon $appliedcoupon){
        $appliedcoupon->delete();
        return response()->json([
            'status' => 'ok',
            'message' => 'Coupon Successfully Detach'
        ]);
    }
}
