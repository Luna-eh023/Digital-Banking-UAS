<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>OTP Verification</title>
</head>

<body class="page-body theme-{{ session('theme', 'light') }}">
    <main class="standalone-page">
        <header class="page-hero">
            <div>
                <p class="eyebrow">Secure access</p>
                <h1>Verifikasi OTP</h1>
                <p>Masukkan kode OTP setelah login untuk masuk ke dashboard Digital Banking.</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="ghost-button light">Keluar</button>
            </form>
        </header>

        <section class="security-grid">
            <form class="panel form-panel" action="{{ route('otp.store') }}" method="POST">
                @csrf

                <div>
                    <p class="eyebrow">OTP</p>
                    <h2>Kode keamanan</h2>
                </div>

                @if (session('status'))
                    <div class="notice info">{{ session('status') }}</div>
                @endif

                @if (session('demo_otp'))
                    <div class="notice success">
                        Kode OTP demo: <strong>{{ session('demo_otp') }}</strong>
                        <br><small>OTP juga tercatat di <code>storage/logs/laravel.log</code>.</small>
                    </div>
                @elseif ($latestOtp)
                    <div class="notice info">Kode terakhir berlaku sampai {{ $latestOtp->expired_at->format('H:i') }}.</div>
                @endif

                <label for="otp_code">
                    Kode OTP
                    <input
                        id="otp_code"
                        type="text"
                        name="otp_code"
                        inputmode="numeric"
                        maxlength="6"
                        placeholder="6 digit OTP"
                        autocomplete="one-time-code"
                        required
                        autofocus
                    >
                </label>
                @error('otp_code')
                    <p class="input-error">{{ $message }}</p>
                @enderror

                <button class="primary-action" type="submit">Masuk dashboard</button>
            </form>

            <aside class="panel help-panel">
                <p class="eyebrow">Bantuan kode</p>
                <h2>Kirim ulang OTP</h2>
                <p>Gunakan tombol ini jika kode sebelumnya kedaluwarsa. Pada mode demo, kode akan ditampilkan di layar.</p>
                <form method="POST" action="{{ route('otp.resend') }}">
                    @csrf
                    <button class="ghost-button" type="submit">Kirim ulang kode</button>
                </form>
            </aside>
        </section>
    </main>
</body>

</html>
