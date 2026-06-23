<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TransactionHistoryController;
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/security', [SecurityController::class, 'index'])->name('security.index');
Route::post('/security', [SecurityController::class, 'store'])->name('security.store');

Route::middleware('auth')->group(function (): void {
    Route::get('/otp', [OTPController::class, 'index'])->name('otp.index');
    Route::post('/otp', [OTPController::class, 'store'])->name('otp.store');
    Route::post('/otp/resend', [OTPController::class, 'resend'])->name('otp.resend');

    Route::middleware('otp.verified')->group(function (): void {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/payment', [PayController::class, 'index'])->name('payment.index');
        Route::post('/payment', [PayController::class, 'store'])->name('payment.store');

        Route::get('/transactions', [TransactionHistoryController::class, 'index'])->name('transactions.index');
        Route::get('/status', [StatusController::class, 'index'])->name('status.index');
        Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings/theme', [SettingController::class, 'theme'])->name('settings.theme');

        Route::resource('accounts', AccountController::class);
        Route::resource('balances', BalanceController::class);
        Route::get('/transfers/create', [TransferController::class, 'create'])->name('transfers.create');
        Route::post('/transfers', [TransferController::class, 'store'])->name('transfers.store');
        Route::get('/transactions/history', [TransactionHistoryController::class, 'transferHistory'])->name('transactions.history');

        Route::resource('posts', PostController::class);
    });
});
