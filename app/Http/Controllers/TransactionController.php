<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class TransactionController extends Controller
{
    public function history()
    {
        $transactions = Transaction::with('transfer')
            ->orderBy('transaction_date', 'desc')
            ->get();

        return view(
            'transactions.history',
            compact('transactions')
        );
    }
}