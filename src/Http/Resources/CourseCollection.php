<?php

namespace Interview\Backend\Http\Resources;

use Carbon\Carbon;
use Interview\Backend\Models\Coupon;
use SebastianBergmann\Environment\Console;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CourseCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'data' => $this->collection->transform(function ($data) {
                $regular_price = $data->price;
                $after_discount = $data->price;
                $has_discount = false;
                $cut_off = "";
                if (count($data->appliedcoupons)) {
                    $cut_off = "";
                    $value = $data->appliedcoupons()->first();
                    $coupon = Coupon::find($value->coupon_id);
                    if ($coupon->type == "FIXED AMOUNT" &&  $coupon->expire_on > Carbon::now()) {
                        $has_discount = true;
                        $coupon_amount = $coupon->amount;
                        $after_discount = $after_discount - $coupon_amount;
                        $cut_off = number_format($coupon_amount, 2) . " ";
                    } elseif ($coupon->type == "PERCENTAGE" &&  $coupon->expire_on > Carbon::now()) {
                        $has_discount = true;
                        $coupon_amount = $coupon->amount;
                        $after_discount = $after_discount - ($after_discount * ($coupon_amount / 100));
                        $cut_off = number_format($coupon_amount, 2) . "% ";
                    }
                }
                return [
                    'id'             => $data->id,
                    'name'           => $data->name,
                    'regular_price'  => number_format((float) $regular_price, 2),
                    'after_discount' =>  number_format((float) $after_discount, 2),
                    'has_discount'   =>  $has_discount,
                    'img'            => $data->course_image_url,
                    'cut_off'        => $cut_off,
                ];
            }),
        ];
    }

    public function with($request)
    {
        return ['status' => 'ok'];
    }
}
