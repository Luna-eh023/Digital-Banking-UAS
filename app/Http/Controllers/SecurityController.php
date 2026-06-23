<?php

namespace App\Http\Controllers;

use App\Models\OTP;
use App\Models\Security;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SecurityController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $latestOtp = $user
            ? OTP::where('email', $user->email)->latest()->first()
            : null;

        return view('security', compact('user', 'latestOtp'));
    }

    public function store(Request $request): RedirectResponse
    {
        if ($request->input('intent') === 'send_otp') {
            $validated = $request->validate([
                'account' => ['required', 'string', 'max:255'],
            ]);

            $user = $this->findUser($validated['account']);

            if (! $user) {
                return redirect()
                    ->route('security.index')
                    ->withErrors(['account' => 'Akun tidak ditemukan.']);
            }

            $otp = OtpService::generate($user->email, 'reset-password');

            return redirect()
                ->route('security.index')
                ->with('success', 'Kode OTP reset password berhasil dibuat.')
                ->with('demo_otp', $otp)
                ->withInput(['account' => $validated['account']]);
        }

        if ($request->input('intent') === 'reset_password') {
            $validated = $request->validate([
                'account' => ['required', 'string', 'max:255'],
                'otp_code' => ['required', 'digits:6'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
            ]);

            $user = $this->findUser($validated['account']);

            if (! $user) {
                return redirect()
                    ->route('security.index')
                    ->withErrors(['account' => 'Akun tidak ditemukan.'])
                    ->withInput();
            }

            $otp = OtpService::verify($user->email, $validated['otp_code']);

            if (! $otp) {
                return redirect()
                    ->route('security.index')
                    ->withErrors(['otp_code' => 'Kode OTP salah atau sudah kedaluwarsa.'])
                    ->withInput();
            }

            $user->forceFill([
                'password' => Hash::make($validated['password']),
            ])->save();

            return redirect()
                ->route('login')
                ->with('status', 'Password berhasil diganti. Silakan login kembali.');
        }

        $validated = $request->validate([
            'username' => ['required', 'string', 'max:100'],
            'pin' => ['required', 'string', 'min:4', 'max:12'],
            'security_question' => ['required', 'string', 'max:160'],
            'security_answer' => ['required', 'string', 'max:160'],
        ]);

        Security::create($validated);

        return redirect()
            ->route('security.index')
            ->with('success', 'Data security berhasil disimpan.');
    }

    private function findUser(string $account): ?User
    {
        return User::query()
            ->where('email', $account)
            ->orWhere('no_card', $account)
            ->first();
    }
}
