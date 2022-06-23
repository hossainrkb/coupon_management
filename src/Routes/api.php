<?php

use Illuminate\Support\Facades\Route;
use Interview\Backend\Http\Controllers\AppliedableCouponController;
use Interview\Backend\Http\Controllers\CouponController;
use Interview\Backend\Http\Controllers\CourseController;

Route::group(['prefix' => 'api', 'middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'coupons'], function () {
        Route::post("/", [CouponController::class, 'index']);
        Route::post("/store", [CouponController::class, 'store']);
    });
    Route::group(['prefix' => 'applied-coupon'], function () {
        Route::post("category/{category}", [AppliedableCouponController::class, 'appliedCouponOnCategory']);
        Route::post("course/{course}", [AppliedableCouponController::class, 'appliedCouponOnCourse']);
    });
    Route::group(['prefix' => 'courses'], function () {
        Route::post("/", [CourseController::class, 'index']);
    });
});
