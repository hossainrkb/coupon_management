<?php

namespace Interview\Backend\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppliedableCoupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'coupon_id', 
        'appliedable_type',
        'appliedable_id'
    ];    
    public function appliedable()
    {
        return $this->morphTo();
    }
}
