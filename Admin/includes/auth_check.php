<?php
/**
 * Admin/includes/auth_check.php
 * Include at top of every admin page.
 */
if (session_status() === PHP_SESSION_NONE) session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ' . str_repeat('../', substr_count($_SERVER['PHP_SELF'], '/') - 2) . 'Admin/login.php');
    exit;
}
