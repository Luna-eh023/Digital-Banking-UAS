<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOtpIsVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! (bool) $request->session()->get('otp_verified', false)) {
            return redirect()->route('otp.index');
        }

        return $next($request);
    }
}
