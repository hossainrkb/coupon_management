<?php

namespace Interview\Backend\Models;

use Illuminate\Database\Eloquent\Model;
use Interview\Backend\Models\AppliedableCoupon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    public static $class_name = __CLASS__;
    protected $fillable = [
        'name','price'
    ];
    public function appliedcoupons()
    {
        return $this->morphMany(AppliedableCoupon::class, 'appliedable');
    }
    protected $appends = ['course_image_url'];
    public function getCourseImageUrlAttribute()
    {
        $array_img = [
            "c4.jpg","c5.jpg","c3.jpg","c8.jpg","c6.jpg","c7.jpg"
        ];
        $random_keys=array_rand($array_img);
        return  url("image/$array_img[$random_keys]");
    }
}
