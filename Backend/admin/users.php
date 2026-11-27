<?php
/**
 * Backend/admin/users.php
 * Admin API: GET list, PUT update role/status.
 */
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Forbidden']);
    exit;
}

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $search = trim($_GET['search'] ?? '');
    $sql    = "SELECT id, name, email, role, status, created_at FROM users";
    $params = [];
    if ($search) {
        $sql   .= " WHERE name LIKE ? OR email LIKE ?";
        $params = ["%$search%", "%$search%"];
    }
    $sql .= " ORDER BY created_at DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    echo json_encode(['success' => true, 'data' => $stmt->fetchAll()]);
    exit;
}

if ($method === 'PUT') {
    $input  = json_decode(file_get_contents('php://input'), true);
    $id     = (int)($input['id'] ?? 0);
    $field  = $input['field']  ?? '';
    $value  = $input['value']  ?? '';

    // Prevent modifying your own account
    if ($id === (int)$_SESSION['user_id']) {
        echo json_encode(['success' => false, 'message' => 'You cannot modify your own account here.']);
        exit;
    }

    if ($field === 'role' && in_array($value, ['user','admin'])) {
        $db->prepare("UPDATE users SET role = ? WHERE id = ?")->execute([$value, $id]);
        echo json_encode(['success' => true, 'message' => 'User role updated.']);
    } elseif ($field === 'status' && in_array($value, ['active','banned'])) {
        $db->prepare("UPDATE users SET status = ? WHERE id = ?")->execute([$value, $id]);
        echo json_encode(['success' => true, 'message' => 'User status updated.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid field or value.']);
    }
    exit;
}

echo json_encode(['success' => false, 'message' => 'Method not supported.']);
