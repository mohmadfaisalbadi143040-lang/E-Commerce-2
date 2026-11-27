<?php
session_start();
if (isset($_SESSION['user_role'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — Nova Store</title>
    <meta name="description" content="Create your free Nova Store account and start shopping today.">
    <link rel="stylesheet" href="Assets/css/style.css">
    <?php include 'header.php'; ?>
</head>

<body>

    <section class="auth-page">
        <div class="auth-card">

            <div class="auth-logo">
                <img src="Assets/img/nova1.png" alt="Nova Logo">
            </div>

            <h2>Create Account</h2>
            <p class="auth-subtitle">Join Nova Store for exclusive deals</p>

            <div id="auth-message" style="display:none; padding:10px 14px; border-radius:8px; font-size:.85rem; margin-bottom:14px;"></div>

            <form id="register-form" onsubmit="handleRegister(event)">

                <div class="auth-field">
                    <label for="reg-name">Full Name</label>
                    <input type="text" id="reg-name" placeholder="Enter your full name" required autocomplete="name">
                </div>

                <div class="auth-field">
                    <label for="reg-email">Email Address</label>
                    <input type="email" id="reg-email" placeholder="you@example.com" required autocomplete="email">
                </div>

                <div class="auth-field">
                    <label for="reg-password">Password</label>
                    <input type="password" id="reg-password" placeholder="Create a strong password" required autocomplete="new-password" minlength="6">
                </div>

                <div class="auth-field">
                    <label for="reg-confirm">Confirm Password</label>
                    <input type="password" id="reg-confirm" placeholder="Re-enter your password" required autocomplete="new-password" minlength="6">
                </div>

                <button type="submit" class="auth-submit" id="register-submit">
                    Create Account
                </button>

            </form>

            <div class="auth-divider">
                <span>Already have an account?</span>
            </div>

            <p class="auth-link">
                <a href="login.php">Sign in instead →</a>
            </p>

        </div>
    </section>

    <script>
    async function handleRegister(e) {
        e.preventDefault();
        const msgEl  = document.getElementById('auth-message');
        const btn    = document.getElementById('register-submit');
        const pass   = document.getElementById('reg-password').value;
        const confirm= document.getElementById('reg-confirm').value;

        msgEl.style.display = 'none';

        if (pass !== confirm) {
            msgEl.style.cssText = 'display:block; background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.3); color:#f87171;';
            msgEl.textContent   = 'Passwords do not match. Please try again.';
            return;
        }

        btn.textContent = 'Creating account...';
        btn.disabled    = true;

        const data = {
            name:     document.getElementById('reg-name').value,
            email:    document.getElementById('reg-email').value,
            password: pass,
        };

        try {
            const res  = await fetch('../Backend/auth/register.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data),
            });
            const json = await res.json();

            if (json.success) {
                msgEl.style.cssText = 'display:block; background:rgba(16,185,129,.12); border:1px solid rgba(16,185,129,.4); color:#34d399;';
                msgEl.textContent   = json.message;
                setTimeout(() => { window.location.href = json.redirect; }, 900);
            } else {
                msgEl.style.cssText = 'display:block; background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.3); color:#f87171;';
                msgEl.textContent   = json.message || 'Registration failed.';
                btn.textContent = 'Create Account';
                btn.disabled    = false;
            }
        } catch (err) {
            msgEl.style.cssText = 'display:block; background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.3); color:#f87171;';
            msgEl.textContent   = 'Connection error. Is XAMPP running?';
            btn.textContent = 'Create Account';
            btn.disabled    = false;
        }
    }
    </script>

    <?php include 'footer.php'; ?>

</body>
</html>