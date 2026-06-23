<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Security Center</title>
</head>

<body class="page-body theme-{{ session('theme', 'light') }}">
    <main class="standalone-page">
        <header class="page-hero">
            <div>
                <p class="eyebrow">Security</p>
                <h1>Security center</h1>
                <p>Reset password dengan OTP, kelola PIN, dan simpan pertanyaan keamanan akun.</p>
            </div>
            @auth
                <a href="{{ route('dashboard') }}" class="ghost-button light">Kembali dashboard</a>
            @else
                <a href="{{ route('login') }}" class="ghost-button light">Kembali login</a>
            @endauth
        </header>

        @if (session('success'))
            <div class="notice success">{{ session('success') }}</div>
        @endif

        @if (session('demo_otp'))
            <div class="notice success">
                Kode OTP demo: <strong>{{ session('demo_otp') }}</strong>
                <br><small>OTP juga dicatat di terminal/log Laravel (<code>storage/logs/laravel.log</code>).</small>
            </div>
        @endif

        <section class="security-grid">
            <div class="panel form-panel">
                <div>
                    <p class="eyebrow">Lupa password</p>
                    <h2>Reset dengan OTP</h2>
                </div>

                <form class="form-panel" action="{{ route('security.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="intent" value="send_otp">

                    <label for="account">
                        Email atau nomor kartu
                        <input id="account" type="text" name="account" value="{{ old('account', $user->email ?? '') }}" placeholder="email atau nomor kartu" required>
                    </label>
                    @error('account')
                        <p class="input-error">{{ $message }}</p>
                    @enderror

                    <button class="ghost-button" type="submit">Buat kode OTP</button>
                </form>

                <form class="form-panel" action="{{ route('security.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="intent" value="reset_password">

                    <label for="reset_account">
                        Akun
                        <input id="reset_account" type="text" name="account" value="{{ old('account', $user->email ?? '') }}" placeholder="email atau nomor kartu" required>
                    </label>

                    <label for="otp_code">
                        Kode OTP
                        <input id="otp_code" type="text" name="otp_code" inputmode="numeric" maxlength="6" placeholder="6 digit OTP" required>
                    </label>
                    @error('otp_code')
                        <p class="input-error">{{ $message }}</p>
                    @enderror

                    <label for="password">
                        Password baru
                        <input id="password" type="password" name="password" minlength="6" placeholder="Minimal 6 karakter" required>
                    </label>
                    @error('password')
                        <p class="input-error">{{ $message }}</p>
                    @enderror

                    <label for="password_confirmation">
                        Konfirmasi password
                        <input id="password_confirmation" type="password" name="password_confirmation" minlength="6" placeholder="Ulangi password baru" required>
                    </label>

                    <button class="primary-action" type="submit">Ganti password</button>
                </form>
            </div>

            <aside class="panel form-panel">
                <div>
                    <p class="eyebrow">Akun</p>
                    <h2>PIN & pertanyaan keamanan</h2>
                </div>

                <form class="form-panel" action="{{ route('security.store') }}" method="POST">
                    @csrf

                    <label for="username">
                        Username
                        <input id="username" type="text" name="username" value="{{ old('username', $user->name ?? '') }}" placeholder="Username" required>
                    </label>
                    @error('username')
                        <p class="input-error">{{ $message }}</p>
                    @enderror

                    <label for="pin">
                        PIN
                        <input id="pin" type="password" name="pin" minlength="4" maxlength="12" placeholder="PIN transaksi" required>
                    </label>
                    @error('pin')
                        <p class="input-error">{{ $message }}</p>
                    @enderror

                    <label for="security_question">
                        Pertanyaan keamanan
                        <input id="security_question" type="text" name="security_question" value="{{ old('security_question') }}" placeholder="Contoh: Nama sekolah pertama?" required>
                    </label>

                    <label for="security_answer">
                        Jawaban
                        <input id="security_answer" type="text" name="security_answer" value="{{ old('security_answer') }}" placeholder="Jawaban rahasia" required>
                    </label>

                    <button class="primary-action" type="submit">Simpan security</button>
                </form>

                <div class="security-summary">
                    <span>Status OTP</span>
                    <strong>{{ $latestOtp ? 'Aktif' : 'Belum ada' }}</strong>
                    <p>{{ $latestOtp ? 'Kode terakhir berlaku sampai ' . $latestOtp->expired_at->format('H:i') : 'Buat kode OTP untuk reset password.' }}</p>
                </div>
            </aside>
        </section>
    </main>
</body>

</html>
