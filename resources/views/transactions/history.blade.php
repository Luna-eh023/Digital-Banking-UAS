<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <title>Riwayat Transaksi</title>
</head>

<body class="page-body theme-{{ session('theme', 'light') }}">
    <main class="standalone-page">
        <header class="page-hero">
            <div>
                <p class="eyebrow">History</p>
                <h1>Riwayat transaksi transfer</h1>
                <p>Semua mutasi transfer tercatat dengan status dan saldo simulasi.</p>
            </div>
            <div class="topbar-actions">
                <a href="{{ route('transfers.create') }}" class="ghost-button light">Transfer baru</a>
                <a href="{{ route('dashboard') }}" class="ghost-button light">Dashboard</a>
            </div>
        </header>

        <section class="panel history-panel">
            <div class="panel-header">
                <div>
                    <p class="eyebrow">Mutasi</p>
                    <h2>{{ $transactions->count() }} transaksi</h2>
                </div>
            </div>

            @php
                $saldo = (float) (auth()->user()->balance ?? 10000000);
            @endphp

            @forelse($transactions as $trx)
                @php
                    $saldo -= (float) $trx->transfer->amount;
                    $statusClass = \Illuminate\Support\Str::slug($trx->status ?? 'success');
                @endphp
                <div class="history-row">
                    <div class="transaction-main">
                        <span class="transaction-dot"></span>
                        <div>
                            <strong>{{ $trx->transfer->receiver ?? 'Transfer' }}</strong>
                            <p>{{ $trx->transaction_date?->format('d M Y, H:i') ?? $trx->created_at?->format('d M Y, H:i') }} — {{ $trx->transfer->description }}</p>
                        </div>
                    </div>
                    <div class="transaction-amount">
                        <strong>- Rp {{ number_format($trx->transfer->amount, 0, ',', '.') }}</strong>
                        <span class="status-pill status-{{ $statusClass }}">{{ $trx->status }}</span>
                        <small>Saldo: Rp {{ number_format(max($saldo, 0), 0, ',', '.') }}</small>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    Belum ada transaksi transfer. Buat transfer pertama dari menu Transfer.
                </div>
            @endforelse
        </section>
    </main>
</body>

</html>
