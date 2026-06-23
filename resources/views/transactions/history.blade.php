<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Transaksi</title>

    <style>
        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            border:1px solid #ccc;
            padding:10px;
        }

        th{
            background:#f5f5f5;
        }
    </style>
</head>
<body>

<h2>Riwayat Transaksi</h2>

<table>

    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Mutasi</th>
            <th>Saldo</th>
        </tr>
    </thead>

    <tbody>

    @php
        $saldo = 10000000;
    @endphp

    @foreach($transactions as $trx)

        @php
            $saldo -= $trx->transfer->amount;
        @endphp

        <tr>
            <td>
                {{ $trx->transaction_date }}
            </td>

            <td>
                {{ $trx->transfer->description }}
            </td>

            <td>
                - Rp {{ number_format($trx->transfer->amount,0,',','.') }}
            </td>

            <td>
                Rp {{ number_format($saldo,0,',','.') }}
            </td>
        </tr>

    @endforeach

    </tbody>

</table>

<br>

<a href="{{ route('transfers.create') }}">
    Kembali ke Transfer
</a>

</body>
</html>