<?php

namespace App\Http\Controllers;

use App\Models\Pay;

class StatusController extends Controller
{
    public function index()
    {
        $payments = Pay::with('statuses')->latest()->get();

        return view('status', compact('payments'));
    }
}
