<?php

namespace App\Http\Controllers;

use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayController extends Controller
{
    public function index()
    {
        return view('payment');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        $payment = Pay::create([
            'user_id' => Auth::id(),
            'amount' => $validated['amount'],
            'status' => 'Pending',
        ]);

        $payment->statuses()->create([
            'status' => 'Pending',
        ]);

        return redirect()->route('status.index')->with('success', 'Payment berhasil dibuat.');
    }
}
