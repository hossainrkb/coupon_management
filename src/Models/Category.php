<?php

namespace Interview\Backend\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public static $class_name = __CLASS__;
    protected $fillable = [
        'name',
    ];
    protected $appends = ['category_image_url'];
    
    public function appliedcoupons()
    {
        return $this->morphMany(AppliedableCoupon::class, 'appliedable');
    }
    public function courses(){
        return $this->belongsToMany(Course::class, 'course_categories', 'category_id', 'course_id');

    }

    public function getCategoryImageUrlAttribute()
    {
        $array_img = [
            "cat3.jpg",
            "cat4.jpg",
            "cat5.jpg",
            "cat6.jpg",
            "cat8.jpg",
            "cat7.jpg",
        ];
        $random_keys=array_rand($array_img);
        return  url("image/$array_img[$random_keys]");
    }
}
