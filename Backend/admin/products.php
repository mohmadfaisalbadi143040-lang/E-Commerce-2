<?php
/**
 * Backend/admin/products.php
 * CRUD API for products — admin only.
 * GET    → list all products
 * POST   → add product
 * PUT    → update product
 * DELETE → delete product
 */
session_start();
header('Content-Type: application/json');
require_once __DIR__ . '/../config/db.php';

// Admin guard
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    http_response_code(403);
    echo json_encode(['success' => false, 'message' => 'Forbidden']);
    exit;
}

$db     = getDB();
$method = $_SERVER['REQUEST_METHOD'];

// ── GET: list all ─────────────────────────────────────────────────────────────
if ($method === 'GET') {
    $search   = '%' . trim($_GET['search'] ?? '') . '%';
    $category = $_GET['category'] ?? '';
    $sql      = "SELECT * FROM products";
    $params   = [];
    $where    = [];

    if (!empty(trim($_GET['search'] ?? ''))) {
        $where[]  = "name LIKE ?";
        $params[] = '%' . trim($_GET['search']) . '%';
    }
    if ($category) {
        $where[]  = "category = ?";
        $params[] = $category;
    }
    if ($where) $sql .= " WHERE " . implode(" AND ", $where);
    $sql .= " ORDER BY created_at DESC";

    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    echo json_encode(['success' => true, 'data' => $stmt->fetchAll()]);
    exit;
}

// ── POST: add product ─────────────────────────────────────────────────────────
if ($method === 'POST') {
    $input    = json_decode(file_get_contents('php://input'), true);
    $name     = trim($input['name']      ?? '');
    $category = trim($input['category']  ?? '');
    $price    = (float)($input['price']  ?? 0);
    $oldPrice = (float)($input['old_price'] ?? 0) ?: null;
    $discount = (int)($input['discount'] ?? 0);
    $image    = trim($input['image']     ?? '');
    $stock    = (int)($input['stock']    ?? 0);
    $featured = (int)($input['featured'] ?? 0);

    if (!$name || !$category || $price <= 0) {
        echo json_encode(['success' => false, 'message' => 'Name, category and price are required.']);
        exit;
    }

    $stmt = $db->prepare("INSERT INTO products (name, category, price, old_price, discount, image, stock, featured) VALUES (?,?,?,?,?,?,?,?)");
    $stmt->execute([$name, $category, $price, $oldPrice, $discount, $image, $stock, $featured]);
    echo json_encode(['success' => true, 'message' => 'Product added.', 'id' => $db->lastInsertId()]);
    exit;
}

// ── PUT: update product ───────────────────────────────────────────────────────
if ($method === 'PUT') {
    $input    = json_decode(file_get_contents('php://input'), true);
    $id       = (int)($input['id'] ?? 0);
    if (!$id) { echo json_encode(['success' => false, 'message' => 'Product ID required.']); exit; }

    $name     = trim($input['name']      ?? '');
    $category = trim($input['category']  ?? '');
    $price    = (float)($input['price']  ?? 0);
    $oldPrice = (float)($input['old_price'] ?? 0) ?: null;
    $discount = (int)($input['discount'] ?? 0);
    $image    = trim($input['image']     ?? '');
    $stock    = (int)($input['stock']    ?? 0);
    $featured = (int)($input['featured'] ?? 0);

    $stmt = $db->prepare("UPDATE products SET name=?, category=?, price=?, old_price=?, discount=?, image=?, stock=?, featured=? WHERE id=?");
    $stmt->execute([$name, $category, $price, $oldPrice, $discount, $image, $stock, $featured, $id]);
    echo json_encode(['success' => true, 'message' => 'Product updated.']);
    exit;
}

// ── DELETE ────────────────────────────────────────────────────────────────────
if ($method === 'DELETE') {
    $input = json_decode(file_get_contents('php://input'), true);
    $id    = (int)($input['id'] ?? $_GET['id'] ?? 0);
    if (!$id) { echo json_encode(['success' => false, 'message' => 'Product ID required.']); exit; }

    $db->prepare("DELETE FROM products WHERE id = ?")->execute([$id]);
    echo json_encode(['success' => true, 'message' => 'Product deleted.']);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Method not supported.']);
