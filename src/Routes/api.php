<?php

use Illuminate\Support\Facades\Route;

// Beginning Of HelloApiController Routes

use BTAL\XYZ\ABC\Http\Controllers\Api\HelloApiController;

Route::prefix('hellos')->group(function () {
    Route::prefix('api')->group(function () {

        Route::get('/', [HelloApiController::class, 'index']);
        Route::get('/view/{id}', [HelloApiController::class, 'view']);
        Route::get('/edit/{id}', [HelloApiController::class, 'edit']);

        Route::post('/store', [HelloApiController::class, 'store']);
        Route::post('/update/{id}', [HelloApiController::class, 'update']);

        Route::get('/delete/{id}', [HelloApiController::class, 'delete']);
    });
});

// End Of HelloApiController Routes


