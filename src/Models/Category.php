<?php

namespace Interview\Backend\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public static $class_name = __CLASS__;
    public function appliedcoupons()
    {
        return $this->morphMany(AppliedableCoupon::class, 'appliedable');
    }
}
