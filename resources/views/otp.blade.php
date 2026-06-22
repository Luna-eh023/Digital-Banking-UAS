<!DOCTYPE html>
<html>
<head>
    <title>OTP</title>
</head>
<body>

<h1>Halaman OTP</h1>

@if(session('success'))
    <h3 style="color:green">
        {{ session('success') }}
    </h3>
@endif

<form action="/otp" method="POST">
    @csrf

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <button type="submit">
        Generate OTP
    </button>
</form>

</body>
</html>