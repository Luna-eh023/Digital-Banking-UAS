<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Transfer Dana</title>
</head>

<body class="page-body theme-{{ session('theme', 'light') }}">
    <main class="standalone-page">
        <header class="page-hero">
            <div>
                <p class="eyebrow">Transfer</p>
                <h1>Transfer dana</h1>
                <p>Kirim dana ke penerima dengan tampilan fresh navy & putih yang konsisten dengan dashboard.</p>
            </div>
            <div class="topbar-actions">
                <a href="{{ route('dashboard') }}" class="ghost-button light">Dashboard</a>
                <a href="{{ route('transactions.index') }}" class="ghost-button light">History</a>
            </div>
        </header>

        @if (session('success'))
            <div class="notice success">{{ session('success') }}</div>
        @endif

        <section class="form-grid">
            <form class="panel form-panel" action="{{ route('transfers.store') }}" method="POST">
                @csrf

                <div>
                    <p class="eyebrow">Form transfer</p>
                    <h2>Detail penerima</h2>
                </div>

                <label for="receiver">
                    Nama penerima
                    <input id="receiver" type="text" name="receiver" value="{{ old('receiver') }}" placeholder="Contoh: Raka Pratama" required>
                </label>
                @error('receiver')
                    <p class="input-error">{{ $message }}</p>
                @enderror

                <label for="amount">
                    Nominal transfer
                    <input id="amount" type="number" name="amount" min="1000" step="1000" value="{{ old('amount') }}" placeholder="Contoh: 50000" required>
                </label>
                @error('amount')
                    <p class="input-error">{{ $message }}</p>
                @enderror

                <label for="description">
                    Keterangan
                    <textarea id="description" name="description" placeholder="Contoh: pembayaran tagihan">{{ old('description') }}</textarea>
                </label>
                @error('description')
                    <p class="input-error">{{ $message }}</p>
                @enderror

                <button class="primary-action" type="submit">Proses transfer</button>
            </form>

            <aside class="panel help-panel">
                <p class="eyebrow">Alternatif</p>
                <h2>Payment cepat</h2>
                <p>Gunakan menu Payment jika ingin transfer langsung dari saldo akun dengan notifikasi otomatis.</p>
                <a href="{{ route('payment.index') }}" class="ghost-button">Buka payment</a>

                <div class="security-summary">
                    <span>Status</span>
                    <strong>Siap transfer</strong>
                    <a href="{{ route('status.index') }}">Lihat status transaksi</a>
                </div>
            </aside>
        </section>
    </main>
</body>

</html>
