<?php

namespace Interview\Backend\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
