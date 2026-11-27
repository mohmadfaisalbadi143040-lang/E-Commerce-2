<?php
/**
 * Admin/login.php — Admin-only login page
 */
session_start();
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login — Nova Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/admin.css">
    <style>
        /* extra decoration */
        .deco-dots {
            position: absolute; bottom: -80px; left: -80px;
            width: 350px; height: 350px;
            background: radial-gradient(circle, rgba(124,58,237,.1) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }
        .hint-box {
            background: rgba(124,58,237,.08);
            border: 1px solid rgba(124,58,237,.25);
            border-radius: 8px;
            padding: 12px 14px;
            margin-top: 20px;
            font-size: .78rem;
            color: var(--text-muted);
        }
        .hint-box strong { color: var(--accent-light); }
    </style>
</head>
<body>
<div class="admin-login-page">
    <div class="deco-dots"></div>

    <div class="admin-login-card">
        <div class="login-brand">
            <div class="login-brand-icon"><i class="fas fa-shield-alt"></i></div>
            <h1 class="login-title">Admin Access</h1>
            <p class="login-sub">Nova Store Control Panel</p>
        </div>

        <div class="login-error" id="login-error"></div>

        <form id="admin-login-form">
            <div class="login-field">
                <label for="admin-email">Email Address</label>
                <input type="email" id="admin-email" placeholder="admin@nova.com" required autocomplete="email">
            </div>
            <div class="login-field">
                <label for="admin-password">Password</label>
                <input type="password" id="admin-password" placeholder="Enter admin password" required autocomplete="current-password">
            </div>
            <button type="submit" class="login-submit" id="login-btn">
                <i class="fas fa-sign-in-alt"></i> &nbsp; Sign In to Admin
            </button>
        </form>

        <div class="hint-box">
            <strong>Default credentials</strong> (after running install.php):<br>
            Email: <strong>admin@nova.com</strong> &nbsp;|&nbsp; Password: <strong>admin123</strong>
        </div>

        <p class="login-back">
            ← <a href="../Frontend/index.php">Back to Store</a>
        </p>
    </div>
</div>

<script>
document.getElementById('admin-login-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn   = document.getElementById('login-btn');
    const errEl = document.getElementById('login-error');
    errEl.style.display = 'none';
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> &nbsp; Signing in...';

    const data = {
        email:    document.getElementById('admin-email').value,
        password: document.getElementById('admin-password').value,
    };

    try {
        const res  = await fetch('../Backend/auth/login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data),
        });
        const json = await res.json();

        if (json.success && json.role === 'admin') {
            btn.innerHTML = '<i class="fas fa-check"></i> &nbsp; Access Granted!';
            setTimeout(() => { window.location.href = 'index.php'; }, 600);
        } else if (json.success && json.role !== 'admin') {
            errEl.textContent = 'This account does not have admin privileges.';
            errEl.style.display = 'block';
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-sign-in-alt"></i> &nbsp; Sign In to Admin';
        } else {
            errEl.textContent = json.message || 'Login failed.';
            errEl.style.display = 'block';
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-sign-in-alt"></i> &nbsp; Sign In to Admin';
        }
    } catch (err) {
        errEl.textContent = 'Network error. Is XAMPP running?';
        errEl.style.display = 'block';
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-sign-in-alt"></i> &nbsp; Sign In to Admin';
    }
});
</script>
</body>
</html>
