<?php

use Illuminate\Support\Facades\Route;

// Beginning Of HelloController Routes

use BTAL\XYZ\ABC\Http\Controllers\HelloController;

Route::group(['middleware' => ['web'], 'prefix' => 'hellos', 'as' => 'hellos.'], function () {

    Route::get('/', [HelloController::class, 'index'])->name('index');
    Route::get('/create', [HelloController::class, 'create'])->name('create');
    Route::get('/view/{id}', [HelloController::class, 'view'])->name('view');
    Route::get('/edit/{id}', [HelloController::class, 'edit'])->name('edit');

    Route::post('/store', [HelloController::class, 'store'])->name('store');
    Route::post('/update/{id}', [HelloController::class, 'update'])->name('update');

    Route::get('/delete/{id}', [HelloController::class, 'delete'])->name('delete');
});

// End Of HelloController Routes


