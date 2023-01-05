<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('users', UserController::class);
Route::apiResource('carts', CartController::class)->only('show', 'index');
Route::put('/carts/{cart}/add-product', [CartController::class, 'addProduct']);
Route::put('/carts/{cart}/remove-product', [CartController::class, 'removeProduct']);
Route::put('/carts/{cart}/remove-all-products', [CartController::class, 'removeAllProducts']);
Route::apiResource('products', ProductController::class);
Route::apiResource('orders', OrderController::class);