<?php
    $errors = $errors ?? new \Illuminate\Support\ViewErrorBag();
    $accountError = $errors->first('no_card');
    $passwordError = $errors->first('password');
    $loginError = $errors->first('login');
    $logoPath = asset('images/bank-logo.jpeg');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo e(asset('css/login.css')); ?>">
    <title>Login - Digital Banking</title>
</head>

<body>
    <main class="main-container centered-flex">
        <div class="login-layout">
            <section class="brand-panel" aria-label="Digital Banking">
                <div class="brand-lockup">
                    <img src="<?php echo e($logoPath); ?>" alt="Logo Digital Banking" class="brand-photo">
                    <div>
                        <p class="brand-kicker">Digital Banking</p>
                        <h1>Digeboy</h1>
                    </div>
                </div>
                <p class="brand-copy">Masuk untuk menjadi bagian dari Digeboy</p>
            </section>

            <section class="form-container" aria-labelledby="login-title">
                <div class="logo-shell">
                    <img src="<?php echo e($logoPath); ?>" alt="Logo bank" class="bank-logo">
                </div>

                <form method="POST" action="<?php echo e(route('login.store')); ?>" class="login-form centered-flex" novalidate>
                    <?php echo csrf_field(); ?>

                    <p class="eyebrow">Secure access</p>
                    <div class="title" id="login-title">LOGIN</div>

                    <?php if (session('status')): ?>
                        <div class="notice success"><?php echo e(session('status')); ?></div>
                    <?php endif; ?>

                    <?php if ($loginError): ?>
                        <div class="notice error"><?php echo e($loginError); ?></div>
                    <?php endif; ?>

                    <div class="msg" aria-live="polite"></div>

                    <div class="field">
                        <label for="no_card">No Kartu / Email</label>
                        <input
                            type="text"
                            name="no_card"
                            id="no_card"
                            value="<?php echo e(old('no_card')); ?>"
                            placeholder="Masukkan no kartu atau email"
                            autocomplete="username"
                            aria-invalid="<?php echo $accountError ? 'true' : 'false'; ?>"
                            required
                            autofocus
                        >
                        <?php if ($accountError): ?>
                            <p class="input-error" id="no-card-error"><?php echo e($accountError); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            aria-invalid="<?php echo $passwordError ? 'true' : 'false'; ?>"
                            required
                        >
                        <?php if ($passwordError): ?>
                            <p class="input-error" id="password-error"><?php echo e($passwordError); ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="action centered-flex">
                        <label for="remember" class="remember centered-flex">
                            <input type="checkbox" name="remember" id="remember" value="1" <?php echo old('remember') ? 'checked' : ''; ?>>
                            Ingat saya
                        </label>
                        <a href="<?php echo e(route('login')); ?>">Lupa password?</a>
                    </div>

                    <div class="btn-container">
                        <button type="submit" id="login-btn" class="login-button">
                            Masuk
                        </button>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <script src="<?php echo e(asset('js/login.js')); ?>" defer></script>
</body>
</html>

