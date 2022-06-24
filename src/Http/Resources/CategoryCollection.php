<?php

namespace Interview\Backend\Http\Resources;

use Carbon\Carbon;
use Interview\Backend\Models\Coupon;
use SebastianBergmann\Environment\Console;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
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
                $has_discount = false;
                $cut_off = "";
                if (count($data->appliedcoupons)) {
                    $cut_off = "";
                    foreach ($data->appliedcoupons as $key => $value) {
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
                return [
                    'id'             => $data->id,
                    'name'           => $data->name,
                    'has_discount'   =>  $has_discount,
                    'img'            => $data->category_image_url,
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
