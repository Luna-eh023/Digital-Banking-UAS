<?php

namespace App\Services;

use App\Models\OTP;
use Illuminate\Support\Facades\Log;

class OtpService
{
    public static function generate(string $email, string $context = 'login'): string
    {
        $otp = (string) random_int(100000, 999999);

        OTP::create([
            'email' => $email,
            'otp_code' => $otp,
            'expired_at' => now()->addMinutes(5),
        ]);

        Log::info("[OTP {$context}] {$email} => {$otp}");

        if (app()->runningInConsole()) {
            echo "[OTP {$context}] {$email} => {$otp}\n";
        }

        return $otp;
    }

    public static function verify(string $email, string $code): ?OTP
    {
        return OTP::where('email', $email)
            ->where('otp_code', $code)
            ->where('expired_at', '>=', now())
            ->latest()
            ->first();
    }
}
