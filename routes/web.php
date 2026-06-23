<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('posts', PostController::class);

Route::resource('transfers', TransferController::class);

Route::get('/transactions/history',
    [TransactionController::class, 'history']
)->name('transactions.history');
