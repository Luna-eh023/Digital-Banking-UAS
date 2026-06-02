<!DOCTYPE html>
<html>
<head>
    <title>Payment Status</title>
</head>
<body>

    <h1>Payment Status</h1>

    @foreach($payments as $payment)

        <p>
            Amount: {{ $payment->amount }}
        </p>

        <p>
            Status: {{ $payment->status }}
        </p>

        <hr>

    @endforeach

</body>
</html>