<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            color: #111827;
            background:
                linear-gradient(135deg, rgba(17, 24, 39, 0.96), rgba(15, 23, 42, 0.92)),
                #111827;
        }

        .page {
            width: min(1080px, calc(100% - 32px));
            margin: 0 auto;
            padding: 48px 0;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 28px;
            color: #ffffff;
        }

        .brand {
            margin: 0;
            font-size: 28px;
            line-height: 1.2;
        }

        .nav-link {
            color: #111827;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px 14px;
            text-decoration: none;
            font-weight: 700;
        }

        .alert {
            margin-bottom: 18px;
            border-radius: 8px;
            padding: 14px 16px;
            color: #064e3b;
            background: #d1fae5;
            border: 1px solid #a7f3d0;
            font-weight: 700;
        }

        .panel {
            overflow: hidden;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 24px 70px rgba(0, 0, 0, 0.28);
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 24px;
            color: #ffffff;
            background: #0f172a;
        }

        .panel-head h2 {
            margin: 0;
            font-size: 22px;
        }

        .count {
            min-width: 44px;
            border-radius: 8px;
            padding: 8px 12px;
            text-align: center;
            color: #111827;
            background: #ffffff;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            color: #4b5563;
            background: #f9fafb;
            font-size: 13px;
            text-transform: uppercase;
        }

        .amount {
            font-weight: 800;
        }

        .badge {
            display: inline-block;
            border-radius: 8px;
            padding: 7px 10px;
            color: #111827;
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            font-size: 13px;
            font-weight: 800;
        }

        .badge-pending {
            color: #92400e;
            background: #fef3c7;
            border-color: #fde68a;
        }

        .empty {
            padding: 36px 24px;
            text-align: center;
            color: #6b7280;
        }

        @media (max-width: 720px) {
            .topbar,
            .panel-head {
                align-items: flex-start;
                flex-direction: column;
            }

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead {
                display: none;
            }

            tr {
                border-bottom: 1px solid #e5e7eb;
            }

            td {
                display: flex;
                justify-content: space-between;
                gap: 16px;
                border-bottom: 0;
            }

            td::before {
                content: attr(data-label);
                color: #6b7280;
                font-weight: 700;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <header class="topbar">
            <h1 class="brand">Payment Status</h1>
            <a class="nav-link" href="{{ route('payment.index') }}">Buat Payment</a>
        </header>

        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <section class="panel">
            <div class="panel-head">
                <h2>Daftar Payment</h2>
                <span class="count">{{ $payments->count() }}</span>
            </div>

            @if($payments->isEmpty())
                <div class="empty">Belum ada payment yang tersimpan.</div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            @php
                                $currentStatus = $payment->statuses->last()?->status ?? $payment->status;
                            @endphp
                            <tr>
                                <td data-label="No">{{ $loop->iteration }}</td>
                                <td data-label="Amount" class="amount">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                                <td data-label="Status">
                                    <span class="badge {{ strtolower($currentStatus) === 'pending' ? 'badge-pending' : '' }}">
                                        {{ $currentStatus }}
                                    </span>
                                </td>
                                <td data-label="Tanggal">{{ $payment->created_at?->format('d M Y H:i') ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </section>
    </main>
</body>
</html>
