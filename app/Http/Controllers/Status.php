<?php

namespace App\Http\Controllers;

use App\Models\Pay;

class StatusController extends Controller
{
    public function index()
    {
        $payments = Pay::all();

        return view('status', compact('payments'));
    }
}