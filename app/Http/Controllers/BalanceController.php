<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index()
    {
        $balances = Balance::all();
        return view('balances.index', compact('balances'));
    }

    public function create()
    {
        return view('balances.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_id' => 'required',
            'amount' => 'required|numeric'
        ]);

        Balance::create($request->all());

        return redirect()->route('balances.index');
    }
}