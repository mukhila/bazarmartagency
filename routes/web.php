<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\ProductsApiController;
use App\Http\Controllers\Api\OrderApiController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/shopnow', [ProductController::class, 'shopnow'])->name('shopnow');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');

Route::post('/orders', [OrderController::class, 'store']);



Route::get('/api/products', [ProductsApiController::class, 'index'])->name('products');
Route::post('/api/orders',   [OrderApiController::class, 'store']);