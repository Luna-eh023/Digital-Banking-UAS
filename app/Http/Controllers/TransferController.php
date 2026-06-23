<?php

namespace App\Http\Controllers;

use App\Models\Transfer;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index()
    {
        $transfers = Transfer::all();

        return view('transfers.index', compact('transfers'));
    }

    public function create()
    {
        return view('transfers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'receiver' => 'required',
            'amount' => 'required|numeric|min:1000',
            'description' => 'required'
        ]);

        $transfer = Transfer::create([
            'sender' => 'Digital Banking',
            'receiver' => $request->receiver,
            'amount' => $request->amount,
            'description' => $request->description
        ]);

        Transaction::create([
            'transfer_id' => $transfer->id,
            'status' => 'Success',
            'transaction_date' => now()
        ]);

        return redirect()
            ->route('transactions.history')
            ->with('success', 'Transfer berhasil');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}