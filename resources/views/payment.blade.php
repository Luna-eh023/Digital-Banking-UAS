<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
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
            width: min(960px, calc(100% - 32px));
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

        .panel {
            display: grid;
            grid-template-columns: 1fr 1fr;
            overflow: hidden;
            border-radius: 8px;
            background: #ffffff;
            box-shadow: 0 24px 70px rgba(0, 0, 0, 0.28);
        }

        .summary {
            padding: 36px;
            color: #ffffff;
            background: #0f172a;
        }

        .summary h2 {
            margin: 0 0 14px;
            font-size: 24px;
        }

        .summary p {
            margin: 0;
            color: #d1d5db;
            line-height: 1.6;
        }

        .form-wrap {
            padding: 36px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            color: #111827;
        }

        input {
            width: 100%;
            height: 46px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 0 14px;
            font-size: 16px;
            color: #111827;
            background: #ffffff;
        }

        input:focus {
            outline: 3px solid rgba(17, 24, 39, 0.14);
            border-color: #111827;
        }

        .error {
            margin: 8px 0 0;
            color: #b91c1c;
            font-size: 14px;
        }

        .button {
            width: 100%;
            height: 46px;
            margin-top: 18px;
            border: 0;
            border-radius: 8px;
            color: #ffffff;
            background: #111827;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
        }

        .button:hover {
            background: #374151;
        }

        @media (max-width: 720px) {
            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .panel {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <main class="page">
        <header class="topbar">
            <h1 class="brand">Payment</h1>
            <a class="nav-link" href="{{ route('status.index') }}">Lihat Status</a>
        </header>

        <section class="panel">
            <div class="summary">
                <h2>Buat Pembayaran</h2>
                <p>Masukkan nominal pembayaran. Status awal akan otomatis tercatat sebagai Pending.</p>
            </div>

            <form class="form-wrap" action="{{ route('payment.store') }}" method="POST">
                @csrf

                <label for="amount">Amount</label>
                <input
                    id="amount"
                    type="number"
                    name="amount"
                    min="1000"
                    step="1000"
                    value="{{ old('amount') }}"
                    placeholder="Contoh: 50000"
                    required
                >
                @error('amount')
                    <p class="error">{{ $message }}</p>
                @enderror

                <button class="button" type="submit">Make Payment</button>
            </form>
        </section>
    </main>
</body>
</html>
