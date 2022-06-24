<?php

namespace Interview\Backend\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'coupon_number',
        'amount',
        'expire_on'
    ];

    public function applied()
    {
        return $this->hasMany(AppliedableCoupon::class, 'coupon_id');
    }
    protected $appends = ['coupon_expire_on'];
    public function getCouponExpireOnAttribute()
    {
        return  Carbon::parse($this->expire_on)->format("Y-m-d");
    }
}
