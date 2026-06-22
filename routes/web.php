<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\NotificationController;

// TAMBAHKAN INI
use App\Http\Controllers\OTPController;
use App\Http\Controllers\SecurityController;

Route::get('/', function () {
    return redirect('/posts');
});

Route::resource('posts', PostController::class);

Route::get('/payment', [PayController::class, 'index']);
Route::post('/payment', [PayController::class, 'store']);

Route::get('/status', [StatusController::class, 'index']);

Route::get('/notifications', [NotificationController::class, 'index']);


// TAMBAHKAN INI
Route::get('/otp', [OTPController::class, 'index']);
Route::post('/otp', [OTPController::class, 'store']);

Route::get('/security', [SecurityController::class, 'index']);
Route::post('/security', [SecurityController::class, 'store']);