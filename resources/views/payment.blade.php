<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
</head>
<body>

    <h1>Payment Page</h1>

    <form action="/payment" method="POST">
        @csrf

        <label>Amount:</label>
        <input type="number" name="amount" required>

        <br><br>

        <button type="submit">
            Make Payment
        </button>
    </form>

</body>
</html>