<?php
/**
 * Admin/index.php — Dashboard
 */
require_once 'includes/auth_check.php';
require_once '../Backend/config/db.php';

$db = getDB();

// Stats
$totalUsers    = $db->query("SELECT COUNT(*) FROM users WHERE role='user'")->fetchColumn();
$totalProducts = $db->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalOrders   = $db->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$totalRevenue  = $db->query("SELECT COALESCE(SUM(total),0) FROM orders WHERE status='delivered'")->fetchColumn();
$pendingOrders = $db->query("SELECT COUNT(*) FROM orders WHERE status='pending'")->fetchColumn();
$lowStock      = $db->query("SELECT COUNT(*) FROM products WHERE stock < 10")->fetchColumn();

// Recent orders
$recentOrders  = $db->query("
    SELECT o.id, o.total, o.status, o.created_at, u.name AS user_name
    FROM orders o
    LEFT JOIN users u ON o.user_id = u.id
    ORDER BY o.created_at DESC LIMIT 8
")->fetchAll();

// Recent users
$recentUsers   = $db->query("
    SELECT id, name, email, role, created_at
    FROM users ORDER BY created_at DESC LIMIT 5
")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Nova Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
<div class="admin-layout">
    <?php include 'includes/sidebar.php'; ?>

    <div class="main-content">
        <?php include 'includes/header.php'; ?>

        <div class="page-content">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Dashboard <span>Overview</span></h1>
                    <p class="page-subtitle">Welcome back, <?= htmlspecialchars($_SESSION['user_name']) ?>! Here's what's happening.</p>
                </div>
                <a href="../Backend/setup/install.php" class="btn btn-outline btn-sm" style="text-decoration:none;">
                    <i class="fas fa-database"></i> DB Setup
                </a>
            </div>

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card" style="--card-color:#a78bfa; --card-bg:rgba(124,58,237,.12);">
                    <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
                    <div class="stat-info">
                        <div class="stat-value">$<?= number_format($totalRevenue, 0) ?></div>
                        <div class="stat-label">Total Revenue</div>
                        <div class="stat-change up"><i class="fas fa-arrow-up"></i> Delivered orders</div>
                    </div>
                </div>
                <div class="stat-card" style="--card-color:#34d399; --card-bg:rgba(16,185,129,.12);">
                    <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
                    <div class="stat-info">
                        <div class="stat-value"><?= $totalOrders ?></div>
                        <div class="stat-label">Total Orders</div>
                        <div class="stat-change up"><i class="fas fa-clock"></i> <?= $pendingOrders ?> pending</div>
                    </div>
                </div>
                <div class="stat-card" style="--card-color:#60a5fa; --card-bg:rgba(59,130,246,.12);">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-info">
                        <div class="stat-value"><?= $totalUsers ?></div>
                        <div class="stat-label">Customers</div>
                        <div class="stat-change up"><i class="fas fa-user-plus"></i> Registered users</div>
                    </div>
                </div>
                <div class="stat-card" style="--card-color:#fbbf24; --card-bg:rgba(245,158,11,.12);">
                    <div class="stat-icon"><i class="fas fa-box-open"></i></div>
                    <div class="stat-info">
                        <div class="stat-value"><?= $totalProducts ?></div>
                        <div class="stat-label">Products</div>
                        <div class="stat-change <?= $lowStock > 0 ? 'down' : 'up' ?>">
                            <i class="fas fa-exclamation-triangle"></i> <?= $lowStock ?> low stock
                        </div>
                    </div>
                </div>
            </div>

            <!-- Two column layout -->
            <div class="grid-2">

                <!-- Recent Orders -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-shopping-cart" style="color:var(--accent-light);margin-right:8px;"></i> Recent Orders</h3>
                        <a href="orders.php" class="btn btn-outline btn-sm">View All</a>
                    </div>
                    <div class="card-body">
                        <?php if (empty($recentOrders)): ?>
                            <div class="empty-state"><i class="fas fa-shopping-cart"></i><p>No orders yet</p></div>
                        <?php else: ?>
                            <?php foreach ($recentOrders as $order): ?>
                                <?php
                                $badgeMap = [
                                    'pending'    => 'badge-warning',
                                    'processing' => 'badge-info',
                                    'shipped'    => 'badge-purple',
                                    'delivered'  => 'badge-success',
                                    'cancelled'  => 'badge-danger',
                                ];
                                $cls = $badgeMap[$order['status']] ?? 'badge-muted';
                                ?>
                                <div class="order-row">
                                    <span class="order-id">#<?= $order['id'] ?></span>
                                    <div class="order-meta">
                                        <strong><?= htmlspecialchars($order['user_name'] ?? 'Guest') ?></strong>
                                        <span><?= date('M d', strtotime($order['created_at'])) ?></span>
                                    </div>
                                    <span class="badge <?= $cls ?>"><?= $order['status'] ?></span>
                                    <span class="order-amount">$<?= number_format($order['total'], 2) ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Recent Users -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fas fa-users" style="color:var(--accent-light);margin-right:8px;"></i> Recent Users</h3>
                        <a href="users.php" class="btn btn-outline btn-sm">View All</a>
                    </div>
                    <div class="card-body">
                        <?php if (empty($recentUsers)): ?>
                            <div class="empty-state"><i class="fas fa-users"></i><p>No users yet</p></div>
                        <?php else: ?>
                            <?php foreach ($recentUsers as $u): ?>
                                <div class="order-row">
                                    <div class="admin-avatar" style="width:36px;height:36px;flex-shrink:0;">
                                        <i class="fas <?= $u['role'] === 'admin' ? 'fa-user-shield' : 'fa-user' ?>" style="font-size:.75rem;"></i>
                                    </div>
                                    <div class="order-meta">
                                        <strong><?= htmlspecialchars($u['name']) ?></strong>
                                        <span><?= htmlspecialchars($u['email']) ?></span>
                                    </div>
                                    <span class="badge <?= $u['role'] === 'admin' ? 'badge-purple' : 'badge-muted' ?>">
                                        <?= $u['role'] ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div><!-- /grid-2 -->

            <!-- Quick Actions -->
            <div class="card" style="margin-top:24px;">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-bolt" style="color:var(--accent-light);margin-right:8px;"></i> Quick Actions</h3>
                </div>
                <div class="card-body" style="display:flex;gap:12px;flex-wrap:wrap;">
                    <a href="products.php?action=add" class="btn btn-primary" style="text-decoration:none;">
                        <i class="fas fa-plus"></i> Add Product
                    </a>
                    <a href="orders.php?filter=pending" class="btn btn-outline" style="text-decoration:none;">
                        <i class="fas fa-clock"></i> Pending Orders (<?= $pendingOrders ?>)
                    </a>
                    <a href="users.php" class="btn btn-outline" style="text-decoration:none;">
                        <i class="fas fa-users"></i> Manage Users
                    </a>
                    <a href="../Frontend/index.php" class="btn btn-outline" target="_blank" style="text-decoration:none;">
                        <i class="fas fa-store"></i> View Store
                    </a>
                </div>
            </div>

        </div><!-- /page-content -->
    </div><!-- /main-content -->
</div>

<script src="assets/js/admin.js"></script>
</body>
</html>
