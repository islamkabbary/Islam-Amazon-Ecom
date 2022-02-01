<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthStoreController;
use App\Http\Controllers\ChatController;

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

Route::get('/n', function () {
    $notifications = Auth::guard('store')->user()->notifications;
    return view('notf',compact('notifications'));
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/login-is', [AuthStoreController::class , 'login'])->name('postlogin');
Route::get('/chat', [ChatController::class , 'chats']);
Route::get('/chats/{id}', [ChatController::class , 'getUserChat'])->name('chats');
Route::get('/send-message', [ChatController::class , 'sendMessages'])->name('sendMessages');
