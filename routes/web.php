<?php

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Api\Auth\AuthStoreController;
use App\Http\Controllers\PlanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/index', function () {
    $products = Product::all();
    return view('index',compact('products'));
});

Route::get('/checkout/{id}', [PaymentController::class, 'checkout'])->name('checkout');
Route::get('/stripe/{id}', [PaymentController::class, 'stripe'])->name('stripe');
Route::post('/payment', [PaymentController::class, 'charge'])->name('payment');

Route::get('/cart', function () {
    $carts = Cart::all();
    return view('cart',compact('carts'));
})->name('cart');

Route::get('/n', function () {
    $notifications = Auth::guard('store')->user()->notifications;
    return view('notf',compact('notifications'));
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/login-is', [AuthStoreController::class , 'login'])->name('postlogin');
Route::get('/chat', [ChatController::class , 'chats']);
Route::get('/chats/{id}', [ChatController::class , 'getUserChat'])->name('chats');
Route::post('/send-message', [ChatController::class , 'sendMessages'])->name('sendMessages');
