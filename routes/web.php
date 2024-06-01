<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);
Route::post('/post', [ProductController::class, 'store']);
Route::get('/products', [ProductController::class, 'show'])->name('products.show');
Route::post('/add-product', [ProductController::class, 'store'])->name('product.store');




