<?php

namespace Interview\Backend\Models;

use Illuminate\Database\Eloquent\Model;
use Interview\Backend\Models\AppliedableCoupon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    public static $class_name = __CLASS__;
    public function appliedcoupons()
    {
        return $this->morphMany(AppliedableCoupon::class, 'appliedable');
    }
}
