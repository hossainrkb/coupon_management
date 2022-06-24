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
        if (count($this->appliedcoupons)) {
            $cut_off = "";
            foreach ($this->appliedcoupons as $key => $value) {
                $coupon = Coupon::find($value->coupon_id);
                if ($coupon->type == "FIXED AMOUNT" &&  $coupon->expire_on > Carbon::now()) {
                    $has_discount = true;
                    $coupon_amount = $coupon->amount;
                    $cut_off.= number_format($coupon_amount,2)." ";
                } elseif ($coupon->type == "PERCENTAGE" &&  $coupon->expire_on > Carbon::now()) {
                    $has_discount = true;
                    $coupon_amount = $coupon->amount;
                    $cut_off.= number_format($coupon_amount,2)."% ";
                }
            }
        }
        foreach ($this->courses as $key => $course) {
            $courses[] = [
                'id' => $course->id,

            ];
        }
        return [
            'id'                   => $this->id,
            'courses' => $this->courses     
        ];
    }

    public function with($request)
    {
        return [
            'status' => 'ok'
        ];
    }
}
