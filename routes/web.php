<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BalanceController;


use App\Http\Controllers\OTPController;

Route::get('/', function () {
    return redirect('/accounts');
});

Route::resource('posts', PostController::class);

Route::get('/payment', [PayController::class, 'index']);
Route::post('/payment', [PayController::class, 'store']);

Route::get('/status', [StatusController::class, 'index']);

Route::get('/notifications', [NotificationController::class, 'index']);


// OTP dan Security
//Route digunakan untuk menghubungkan URL dengan controller.
//Route GET digunakan untuk menampilkan halaman, sedangkan POST digunakan untuk menyimpan data.

Route::get('/otp', [OTPController::class, 'index']);
Route::post('/otp', [OTPController::class, 'store']);

Route::get('/security', [SecurityController::class, 'index']);
Route::post('/security', [SecurityController::class, 'store']);
