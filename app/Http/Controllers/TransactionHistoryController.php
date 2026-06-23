<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TransactionHistoryController extends Controller
{
    public function index(): View
    {
        $payments = Pay::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('transactions', compact('payments'));
    }

    public function transferHistory(): View
    {
        $transactions = Transaction::with('transfer')
            ->latest('transaction_date')
            ->get();

        return view('transactions.history', compact('transactions'));
    }
}
