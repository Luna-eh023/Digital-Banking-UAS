<!DOCTYPE html>
<html>
<head>
    <title>OTP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h3>Generate OTP</h3>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            //mengirim email ke otp controller
            <form action="/otp" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Email</label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        placeholder="Masukkan Email"
                        required>
                </div>

                <button class="btn btn-primary">
                    Generate OTP
                </button>

            </form>

        </div>
    </div>

</div>

</body>
</html>