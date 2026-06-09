<?php

namespace App\Http\Controllers;

class TransactionController extends Controller
{
    public function history()
    {
        return view('transactions.history');
    }
}