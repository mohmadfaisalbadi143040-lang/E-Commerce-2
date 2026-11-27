<?php
/**
 * Backend/auth/logout.php
 * Destroys session and redirects to frontend login.
 */
session_start();
session_unset();
session_destroy();

$referer = $_SERVER['HTTP_REFERER'] ?? '';
if (str_contains($referer, '/Admin/')) {
    header('Location: ../../Admin/login.php');
} else {
    header('Location: ../../Frontend/index.php');
}
exit;
