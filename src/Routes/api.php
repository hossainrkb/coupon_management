<?php

use Illuminate\Support\Facades\Route;
use Interview\Backend\Http\Controllers\AppliedableCouponController;
use Interview\Backend\Http\Controllers\CategoryController;
use Interview\Backend\Http\Controllers\CouponController;
use Interview\Backend\Http\Controllers\CourseController;

Route::group(['prefix' => 'api', 'middleware' => ['auth:api','bindings']], function () {
    Route::group(['prefix' => 'coupons'], function () {
        Route::post("/", [CouponController::class, 'index']);
        Route::post("/store", [CouponController::class, 'store']);
        Route::post("/show/{coupon}", [CouponController::class, 'show']);
    });
    Route::group(['prefix' => 'applied-coupon'], function () {
        Route::post("category/{category}", [AppliedableCouponController::class, 'appliedCouponOnCategory']);
        Route::post("course/{course}", [AppliedableCouponController::class, 'appliedCouponOnCourse']);
    });
    Route::group(['prefix' => 'detach-coupon'], function () {
        Route::post("/{appliedcoupon}", [AppliedableCouponController::class, 'destroy']);
    });
});
Route::group(['prefix' => 'api/courses'], function () {
    Route::post("/", [CourseController::class, 'index']);
});
Route::group(['prefix' => 'api/category','middleware' => ['bindings']], function () {
    Route::post("/", [CategoryController::class, 'index']);
    Route::post("show/{category}", [CategoryController::class, 'show']);
});
