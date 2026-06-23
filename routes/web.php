<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingController;

Route::get('/', function () {
    return redirect('/posts');
});

Route::resource('posts', PostController::class);
Route::get('/payment', [PayController::class, 'index'])->name('payment.index');
Route::post('/payment', [PayController::class, 'store'])->name('payment.store');
Route::get('/status', [StatusController::class, 'index'])->name('status.index');
Route::get('/notifications', [NotificationController::class, 'index']);
Route::get('/settings', [SettingController::class, 'index']);
