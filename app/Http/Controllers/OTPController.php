<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\OTP;
use App\Services\OtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OTPController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (session('otp_verified')) {
            return redirect()->route('dashboard');
        }

        $latestOtp = OTP::where('email', Auth::user()->email)
            ->latest()
            ->first();

        return view('otp', compact('latestOtp'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'otp_code' => ['required', 'digits:6'],
        ], [
            'otp_code.required' => 'Kode OTP wajib diisi.',
            'otp_code.digits' => 'Kode OTP harus 6 digit.',
        ]);

        $otp = OtpService::verify(Auth::user()->email, $validated['otp_code']);

        if (! $otp) {
            return back()->withErrors([
                'otp_code' => 'Kode OTP salah atau sudah kedaluwarsa.',
            ]);
        }

        $request->session()->put('otp_verified', true);

        Notification::create([
            'user_id' => Auth::id(),
            'title' => 'OTP terverifikasi',
            'message' => 'Verifikasi OTP berhasil dan dashboard sudah aktif.',
            'status' => 'unread',
        ]);

        return redirect()->route('dashboard')->with('success', 'OTP berhasil diverifikasi.');
    }

    public function resend(): RedirectResponse
    {
        $otp = OtpService::generate(Auth::user()->email, 'resend');

        return back()
            ->with('status', 'Kode OTP baru sudah dibuat.')
            ->with('demo_otp', $otp);
    }
}
