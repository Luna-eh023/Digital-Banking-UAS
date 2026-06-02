<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\pay;

class PayController extends Controller
{
    public function index()
    {
        return view('payment');
    }
     public function store(Request $request)
    {
        Pay::create([
            'user_id' => $request->user_id,
            'amount' => $request->amount,
            'status' => 'Pending'
        ]);

        return redirect('/status');
    }
}