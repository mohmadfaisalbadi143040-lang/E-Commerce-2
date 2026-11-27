<?php
session_start();
if (isset($_SESSION['user_role'])) {
    if ($_SESSION['user_role'] === 'admin') header('Location: ../Admin/index.php');
    else header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Nova Store</title>
    <meta name="description" content="Login to your Nova Store account to track orders and manage your shopping.">
    <link rel="stylesheet" href="Assets/css/style.css">
    <?php include 'header.php'; ?>
</head>

<body>

    <section class="auth-page">
        <div class="auth-card">

            <div class="auth-logo">
                <img src="Assets/img/nova1.png" alt="Nova Logo">
            </div>

            <h2>Welcome Back</h2>
            <p class="auth-subtitle">Sign in to your Nova account</p>

            <div id="auth-message" style="display:none; padding:10px 14px; border-radius:8px; font-size:.85rem; margin-bottom:14px;"></div>

            <form id="login-form" onsubmit="handleLogin(event)">

                <div class="auth-field">
                    <label for="login-email">Email Address</label>
                    <input type="email" id="login-email" placeholder="you@example.com" required autocomplete="email">
                </div>

                <div class="auth-field">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" placeholder="Enter your password" required autocomplete="current-password">
                </div>

                <button type="submit" class="auth-submit" id="login-submit">
                    Sign In
                </button>

            </form>

            <div class="auth-divider">
                <span>Don't have an account?</span>
            </div>

            <p class="auth-link">
                <a href="register.php">Create a free account →</a>
            </p>

        </div>
    </section>

    <script>
    async function handleLogin(e) {
        e.preventDefault();
        const btn    = document.getElementById('login-submit');
        const msgEl  = document.getElementById('auth-message');
        btn.textContent = 'Signing in...';
        btn.disabled    = true;
        msgEl.style.display = 'none';

        const data = {
            email:    document.getElementById('login-email').value,
            password: document.getElementById('login-password').value,
        };

        try {
            const res  = await fetch('../Backend/auth/login.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data),
            });
            const json = await res.json();

            if (json.success) {
                msgEl.style.cssText = 'display:block; background:rgba(16,185,129,.12); border:1px solid rgba(16,185,129,.4); color:#34d399;';
                msgEl.textContent   = json.message;
                setTimeout(() => { window.location.href = json.redirect; }, 800);
            } else {
                msgEl.style.cssText = 'display:block; background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.3); color:#f87171;';
                msgEl.textContent   = json.message || 'Login failed.';
                btn.textContent = 'Sign In';
                btn.disabled    = false;
            }
        } catch (err) {
            msgEl.style.cssText = 'display:block; background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.3); color:#f87171;';
            msgEl.textContent   = 'Connection error. Is XAMPP running?';
            btn.textContent = 'Sign In';
            btn.disabled    = false;
        }
    }
    </script>

    <?php include 'footer.php'; ?>

</body>
</html>