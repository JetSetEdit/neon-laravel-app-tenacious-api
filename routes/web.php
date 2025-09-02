<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ProductController;
use App\Http\Controllers\AuthController;

// Authentication routes
Route::get('/', [AuthController::class, 'showTokenForm'])->name('auth.token-form');
Route::post('/auth/authenticate', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Protected product routes
Route::middleware('token.auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
});
