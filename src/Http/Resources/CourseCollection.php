<?php

namespace Interview\Backend\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Interview\Backend\Models\Coupon;

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
                if(count($data->appliedcoupons)){
                    foreach ($data->appliedcoupons as $key => $value) {
                        $coupon = Coupon::find($value->coupon_id);
                        if($coupon->type="FIXED AMOUNT"){
                            $has_discount = true;
                            $coupon_amount = $coupon->amount;
                            $after_discount = $after_discount - $coupon_amount;
                        }
                        elseif($coupon->type="PERCENTAGE"){
                            $has_discount = true;
                            $coupon_amount = $coupon->amount;
                            $after_discount = $after_discount * ($coupon_amount/100);
                        }
                    }
                }
                return [
                    'id'                        => $data->id,
                    'regular_price'             => $regular_price,
                    'after_discount'             => $after_discount,
                    'has_discount'                  =>$has_discount
                ];
            }),
        ];
    }

    public function with($request)
    {
        return ['status' => 'ok'];
    }
}
