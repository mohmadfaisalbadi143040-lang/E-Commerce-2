<?php
/**
 * Backend/admin/orders.php
 * Admin API: GET list, PUT update status.
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
    $status = $_GET['status'] ?? '';
    $sql    = "SELECT o.*, u.name AS user_name, u.email AS user_email
               FROM orders o
               LEFT JOIN users u ON o.user_id = u.id";
    $params = [];
    if ($status) {
        $sql   .= " WHERE o.status = ?";
        $params = [$status];
    }
    $sql .= " ORDER BY o.created_at DESC";
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    $orders = $stmt->fetchAll();

    // Attach items count
    foreach ($orders as &$order) {
        $s = $db->prepare("SELECT COUNT(*) FROM order_items WHERE order_id = ?");
        $s->execute([$order['id']]);
        $order['items_count'] = (int)$s->fetchColumn();
    }
    echo json_encode(['success' => true, 'data' => $orders]);
    exit;
}

if ($method === 'PUT') {
    $input  = json_decode(file_get_contents('php://input'), true);
    $id     = (int)($input['id'] ?? 0);
    $status = trim($input['status'] ?? '');
    $allowed = ['pending','processing','shipped','delivered','cancelled'];
    if (!$id || !in_array($status, $allowed)) {
        echo json_encode(['success' => false, 'message' => 'Invalid ID or status.']);
        exit;
    }
    $db->prepare("UPDATE orders SET status = ? WHERE id = ?")->execute([$status, $id]);
    echo json_encode(['success' => true, 'message' => 'Order status updated.']);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Method not supported.']);
