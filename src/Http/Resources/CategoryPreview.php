<?php

namespace Interview\Backend\Http\Resources;

use Carbon\Carbon;
use Interview\Backend\Models\Coupon;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryPreview extends JsonResource
{
    public function toArray($request)
    {
        $has_discount = false;
        $courses = [];
        $cut_off = "";
        $coupon_amount = 0;
        $coupon_type = '';
        if (count($this->appliedcoupons)) {
            $cut_off = "";
            $value = $this->appliedcoupons()->first();
            $coupon = Coupon::find($value->coupon_id);
            if ($coupon->type == "FIXED AMOUNT" &&  $coupon->expire_on > Carbon::now()) {
                $has_discount = true;
                $coupon_type = 'FIXED AMOUNT';
                $coupon_amount = $coupon->amount;
                $cut_off = number_format($coupon_amount, 2) . " ";
            } elseif ($coupon->type == "PERCENTAGE" &&  $coupon->expire_on > Carbon::now()) {
                $has_discount = true;
                $coupon_type = 'PERCENTAGE';
                $coupon_amount = $coupon->amount;
                $cut_off = number_format($coupon_amount, 2) . "% ";
            }
        }
        foreach ($this->courses as $key => $course) {
            if ($coupon_type == 'FIXED AMOUNT') {
                $after_discount = $course->price - $coupon_amount;
            } else {
                $after_discount = $course->price - ($course->price * ($coupon_amount / 100));
            }
            $courses[] = [
                'id'             => $course->id,
                'name'           => $course->name,
                'regular_price'  => number_format((float) $course->price, 2),
                'after_discount' =>  number_format((float) $after_discount, 2),
                'has_discount'   =>  $has_discount,
                'img'            => $course->course_image_url,
                'cut_off'        => $cut_off,
            ];
        }
        return [
            'id'      => $this->id,
            'name'    => $this->name,
            'courses' => $courses
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'ok'
        ];
    }
}
