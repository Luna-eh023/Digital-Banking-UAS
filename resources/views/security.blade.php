<!DOCTYPE html>
<html>
<head>
    <title>Security</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body{
            background:#f4f6f9;
        }

        .card{
            margin-top:80px;
            box-shadow:0 4px 12px rgba(0,0,0,0.1);
        }

        .card-header{
            font-size:32px;
            font-weight:bold;
        }
    </style>

</head>
<body>

<div class="container">

    <div class="card">

        <div class="card-header bg-primary text-white">
            Security Settings
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            //untuk mengirim data keamanan pengguna ke security controller
            <form action="/security" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">
                        Username
                    </label>

                    <input type="text"
                           name="username"
                           class="form-control"
                           placeholder="Masukkan Username"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        PIN
                    </label>

                    <input type="password"
                           name="pin"
                           class="form-control"
                           placeholder="Masukkan PIN"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Pertanyaan Keamanan
                    </label>

                    <input type="text"
                           name="security_question"
                           class="form-control"
                           placeholder="Contoh: Nama ibu kandung?"
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">
                        Jawaban
                    </label>

                    <input type="text"
                           name="security_answer"
                           class="form-control"
                           placeholder="Masukkan Jawaban"
                           required>
                </div>

                <button class="btn btn-primary">
                    Simpan Security
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>