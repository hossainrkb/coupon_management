<?php

namespace Interview\Backend\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Interview\Backend\Models\AppliedableCoupon;
use Interview\Backend\Models\Coupon;
use Interview\Backend\Models\Course;
use Interview\Backend\Models\Category;

class CouponController extends Controller
{

    public function index()
    {
        $coupons = Coupon::all();
        $return_able_array = [];
        if (count($coupons)) {
            foreach ($coupons as $key => $value) {
                $return_able_array[] = [
                    'id' => $value->id,
                    'type' => $value->type ?? null,
                    'amount' => $value->amount ?? null,
                    'expire_on' => Carbon::parse($value->expire_on)->format("d-M-Y"),
                    'is_expired' => $value->expire_on > Carbon::now() ? 'NO' : 'YES',
                ];
            }
        }
        return response()->json([
            'status' => 'ok',
            'data' => $return_able_array
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCouponRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = Coupon::create([
            'type'   => $request->type,
            'amount' => $request->amount,
            'coupon_number' => $this->getRandomNumber(8),
            'expire_on' => $request->expire_on
        ]);
        return response()->json([
            'status' => 'ok',
            'data' => $coupon
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show($coupon)
    {
        $coupon = Coupon::find($coupon);
        $return_able_array = [];
        $applied_on_cat = [];
        $applied_on_course = [];
        $applied_cats =  $coupon->applied()->where('appliedable_type', Category::$class_name)->get();
        $applied_courses =  $coupon->applied()->where('appliedable_type', Course::$class_name)->get();
        if (count($applied_cats)) {
            foreach ($applied_cats as $applied_cat) {
                $applied_on_cat[] = [
                    'applied_func'=>$applied_cat,
                    'appliedable'=>$applied_cat->appliedable,
                ];
            }
        }
        if (count($applied_courses)) {
            foreach ($applied_courses as $applied_ourse) {
                $applied_on_course[] = [
                    'applied_func'=>$applied_ourse,
                    'appliedable'=>$applied_ourse->appliedable,
                ];
            }
        }
        $return_able_array = [
            'id' => $coupon->id,
            'type' => $coupon->type ?? null,
            'amount' => $coupon->amount ?? null,
            'is_expired' => $coupon->expire_on > Carbon::now() ? 'NO' : 'YES',
            'applied_on_cat_count' => count($applied_on_cat),
            'applied_on_cat' => $applied_on_cat,
            'expire_on' => Carbon::parse($coupon->expire_on)->format("d-M-Y"),
            'coupon_number' => $coupon->coupon_number,
            'applied_on_course_count' => count($applied_on_course),
            'applied_on_course' => $applied_on_course,
            'categories' => Category::whereNotIn('id',AppliedableCoupon::where('appliedable_type', Category::$class_name)->pluck('appliedable_id')->toArray())->get(),
            'courses' => Course::whereNotIn('id',AppliedableCoupon::where('appliedable_type', Course::$class_name)->pluck('appliedable_id')->toArray())->get(),
        ];
        return response()->json([
            'status' => 'ok',
            'data' => $return_able_array
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return response()->json([
            'status' => 'ok',
            'data' => $coupon
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCouponRequest  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $coupon->update([
            'type'   => $request->type,
            'amount' => $request->amount,
            'expire_on' => $request->expire_on
        ]);
        return response()->json([
            'status' => 'ok',
            'data' => $coupon
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }

    public  function getRandomNumber($length = 12, $numeric = false)
    {
        $characters = 'ABCDEFGHJKMNOPQRSTUVWXYZ123456789';
        if ($numeric) {
            $characters = '12345678910111213';
        }
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
