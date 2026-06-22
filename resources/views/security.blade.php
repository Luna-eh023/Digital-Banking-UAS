<!DOCTYPE html>
<html>
<head>
    <title>Security</title>
</head>
<body>

<h1>Halaman Security</h1>

<form action="/security" method="POST">
    @csrf

    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>PIN:</label><br>
    <input type="password" name="pin" required><br><br>

    <label>Pertanyaan Keamanan:</label><br>
    <input type="text" name="security_question" required><br><br>

    <label>Jawaban:</label><br>
    <input type="text" name="security_answer" required><br><br>

    <button type="submit">
        Simpan Security
    </button>

</form>

</body>
</html>