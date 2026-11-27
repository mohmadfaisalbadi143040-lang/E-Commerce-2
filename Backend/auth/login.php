<?php
/**
 * Backend/auth/login.php
 * Handles POST login requests, starts a session, returns JSON.
 */
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$email    = trim($input['email']    ?? '');
$password = trim($input['password'] ?? '');

if (!$email || !$password) {
    echo json_encode(['success' => false, 'message' => 'Email and password are required.']);
    exit;
}

$db   = getDB();
$stmt = $db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user || !password_verify($password, $user['password'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid email or password.']);
    exit;
}

if ($user['status'] === 'banned') {
    echo json_encode(['success' => false, 'message' => 'Your account has been suspended.']);
    exit;
}

// Store session
$_SESSION['user_id']   = $user['id'];
$_SESSION['user_name'] = $user['name'];
$_SESSION['user_email']= $user['email'];
$_SESSION['user_role'] = $user['role'];

$redirect = ($user['role'] === 'admin') ? '../Admin/index.php' : 'index.php';

echo json_encode([
    'success'  => true,
    'message'  => 'Welcome back, ' . $user['name'] . '!',
    'role'     => $user['role'],
    'redirect' => $redirect,
]);
