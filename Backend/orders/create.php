<?php
/**
 * Backend/orders/create.php
 * Handles POST requests to place a new order.
 * Saves record into `orders` and `order_items` tables in database.
 */
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!isset($_SESSION['user_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Please sign in to your account to place an order.',
        'require_login' => true
    ]);
    exit;
}

$userId = $_SESSION['user_id'];
$items  = $input['items'] ?? [];

if (empty($items) || !is_array($items)) {
    echo json_encode(['success' => false, 'message' => 'Your cart is empty.']);
    exit;
}

$subtotal = 0;
foreach ($items as $item) {
    $qty   = max(1, (int)($item['qty'] ?? 1));
    $price = max(0, (float)($item['price'] ?? 0));
    $subtotal += $price * $qty;
}

$shippingCost = $subtotal > 100 ? 0 : 9.99;
$total        = $subtotal + $shippingCost;

try {
    $db = getDB();
    $db->beginTransaction();

    // Insert order record
    $stmt = $db->prepare("INSERT INTO orders (user_id, total, status, created_at) VALUES (?, ?, 'pending', NOW())");
    $stmt->execute([$userId, $total]);
    $orderId = $db->lastInsertId();

    // Insert order line items
    $itemStmt = $db->prepare("INSERT INTO order_items (order_id, name, qty, price) VALUES (?, ?, ?, ?)");
    foreach ($items as $item) {
        $name  = trim($item['name'] ?? 'Product');
        $qty   = max(1, (int)($item['qty'] ?? 1));
        $price = max(0, (float)($item['price'] ?? 0));
        $itemStmt->execute([$orderId, $name, $qty, $price]);
    }

    $db->commit();

    echo json_encode([
        'success'  => true,
        'message'  => 'Order placed successfully!',
        'order_id' => $orderId,
        'total'    => number_format($total, 2),
    ]);

} catch (Exception $e) {
    if (isset($db) && $db->inTransaction()) {
        $db->rollBack();
    }
    echo json_encode(['success' => false, 'message' => 'Failed to place order: ' . $e->getMessage()]);
}
