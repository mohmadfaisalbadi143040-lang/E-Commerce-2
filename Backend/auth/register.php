<?php
/**
 * Backend/auth/register.php
 * Handles POST registration, hashes password, creates user row.
 */
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$input    = json_decode(file_get_contents('php://input'), true);
$name     = trim($input['name']     ?? '');
$email    = trim($input['email']    ?? '');
$password = trim($input['password'] ?? '');

if (!$name || !$email || !$password) {
    echo json_encode(['success' => false, 'message' => 'All fields are required.']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
    exit;
}

if (strlen($password) < 6) {
    echo json_encode(['success' => false, 'message' => 'Password must be at least 6 characters.']);
    exit;
}

$db   = getDB();
$stmt = $db->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->fetch()) {
    echo json_encode(['success' => false, 'message' => 'An account with this email already exists.']);
    exit;
}

$hash = password_hash($password, PASSWORD_BCRYPT);
$ins  = $db->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
$ins->execute([$name, $email, $hash]);
$userId = $db->lastInsertId();

// Auto-login after register
$_SESSION['user_id']    = $userId;
$_SESSION['user_name']  = $name;
$_SESSION['user_email'] = $email;
$_SESSION['user_role']  = 'user';

echo json_encode([
    'success'  => true,
    'message'  => 'Account created! Welcome to Nova, ' . $name . '!',
    'redirect' => 'index.php',
]);
