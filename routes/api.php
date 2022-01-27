<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Api\Web\CartController;
use App\Http\Controllers\Api\Admin\ProductController;
use App\Http\Controllers\Api\Auth\AuthUserController;
use App\Http\Controllers\Api\Admin\CategoryController;
use App\Http\Controllers\Api\Admin\DriverController;
use App\Http\Controllers\Api\Auth\AuthAdminController;
use App\Http\Controllers\Api\Auth\AuthStoreController;
use App\Http\Controllers\Api\Auth\AuthDriverController;
use App\Http\Controllers\OrderController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Login
Route::post('login-user', [AuthUserController::class, "login"]);
Route::post('login-admin', [AuthAdminController::class, "login"]);
Route::post('login-store', [AuthStoreController::class, "login"]);
Route::post('login-driver', [AuthDriverController::class, "login"]);


//LogOut
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::post('logout-user', [AuthUserController::class, "logout"]);
    Route::post('logout-admin', [AuthAdminController::class, "logout"]);
    Route::post('logout-store', [AuthStoreController::class, "logout"]);
    Route::post('logout-driver', [AuthDriverController::class, "logout"]);
});

Route::group(['middleware' => 'jwt.auth'], function () {
    //Categories
    Route::apiResource('category', CategoryController::class);
    //Products
    Route::apiResource('product', ProductController::class);

    //Driver
    Route::apiResource('driver', DriverController::class);
    Route::apiResource('order', OrderController::class);

    Route::post('check-out', [CartController::class, "checkOut"]);
    Route::post('coupon-in-order', [CartController::class, "couponInOrder"]);
});

// Route::get('search', [ProductController::class , 'search']);

Route::apiResource('cart', CartController::class );
Route::get('make', [CartController::class,'make']);