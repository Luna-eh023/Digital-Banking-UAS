<!DOCTYPE html>
<html>
<head>
    <title>Transfer Dana</title>
</head>
<body>

<h2>Transfer Dana</h2>

<form action="{{ route('transfers.store') }}" method="POST">
    @csrf

    <p>
        Nama Penerima
        <br>
        <input type="text" name="receiver">
    </p>

    <p>
        Nominal Transfer
        <br>
        Rp. <input type="number" name="amount">
    </p>

    <p>
        Keterangan
        <br>
        <textarea name="description"></textarea>
    </p>

    <button type="submit">
        Transfer
    </button>
</form>

<br>

<a href="{{ route('transactions.history') }}">
    Lihat Riwayat Transaksi
</a>

</body>
</html>