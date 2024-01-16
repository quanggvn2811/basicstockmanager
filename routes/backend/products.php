<?php

use App\Http\Controllers\Backend\ProductController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'products',
    // 'middleware' => 'role:administrator'
], function () {
    Route::get('stock/{stock}/add/{associated_session?}', [ProductController::class, 'create'])->name('products.create');
    Route::get('stock/{stock}/{associated_session?}', [ProductController::class, 'index'])->name('products.index');
    Route::post('stock/{stock}/add/{associated_session?}', [ProductController::class, 'store'])->name('products.store');
    Route::post('stock/{stock}/edit/{category}{associated_session?}', [ProductController::class, 'update'])->name('products.update');
    Route::post('{product}/update_quantity/{associated_session?}', [ProductController::class, 'updateQuantity'])
        ->name('products.updateQuantity');
});
