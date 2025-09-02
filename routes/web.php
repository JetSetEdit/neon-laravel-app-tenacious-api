<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::get('/products', [App\Http\Controllers\Web\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [App\Http\Controllers\Web\ProductController::class, 'show'])->name('products.show');
