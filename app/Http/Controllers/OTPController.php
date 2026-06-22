<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OTP;

class OTPController extends Controller
{
    public function index()
    {
        return view('otp');
    }

    public function store(Request $request)
    {
        $otp = rand(100000, 999999);

        OTP::create([
            'email' => $request->email,
            'otp_code' => $otp,
            'expired_at' => now()->addMinutes(5)
        ]);

        return back()->with('success', 'OTP berhasil dibuat: ' . $otp);
    }
}