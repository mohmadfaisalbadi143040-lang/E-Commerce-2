<?php
/**
 * Admin/orders.php — Orders Management
 */
require_once 'includes/auth_check.php';
require_once '../Backend/config/db.php';

$db     = getDB();
$filter = $_GET['filter'] ?? '';

$sql    = "SELECT o.*, u.name AS user_name, u.email AS user_email
           FROM orders o
           LEFT JOIN users u ON o.user_id = u.id";
$params = [];
if ($filter) {
    $sql   .= " WHERE o.status = ?";
    $params = [$filter];
}
$sql .= " ORDER BY o.created_at DESC";
$stmt = $db->prepare($sql);
$stmt->execute($params);
$orders = $stmt->fetchAll();

$statusOptions = ['pending','processing','shipped','delivered','cancelled'];
$statusCount   = [];
foreach ($statusOptions as $s) {
    $r = $db->prepare("SELECT COUNT(*) FROM orders WHERE status=?");
    $r->execute([$s]);
    $statusCount[$s] = $r->fetchColumn();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders — Nova Admin</title>
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
                    <h1 class="page-title">Order <span>Management</span></h1>
                    <p class="page-subtitle"><?= count($orders) ?> orders <?= $filter ? "with status <em>$filter</em>" : 'total' ?></p>
                </div>
            </div>

            <!-- Status Filter Pills -->
            <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:20px;">
                <a href="orders.php" class="btn btn-sm <?= !$filter ? 'btn-primary' : 'btn-outline' ?>" style="text-decoration:none;">
                    All <span class="badge badge-muted" style="margin-left:6px;"><?= array_sum($statusCount) ?></span>
                </a>
                <?php
                $pillMap = ['pending'=>'badge-warning','processing'=>'badge-info','shipped'=>'badge-purple','delivered'=>'badge-success','cancelled'=>'badge-danger'];
                foreach ($statusOptions as $s):
                    $active = $filter === $s;
                ?>
                <a href="orders.php?filter=<?= $s ?>"
                   class="btn btn-sm <?= $active ? 'btn-primary' : 'btn-outline' ?>"
                   style="text-decoration:none; text-transform:capitalize;">
                    <?= $s ?> <span class="badge <?= $pillMap[$s] ?>" style="margin-left:6px;"><?= $statusCount[$s] ?></span>
                </a>
                <?php endforeach; ?>
            </div>

            <!-- Search bar -->
            <div class="card" style="margin-bottom:20px;">
                <div class="card-body" style="padding:14px 20px;">
                    <div class="search-input-wrap" style="max-width:340px;">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search by customer name..." oninput="filterTable('order-search','orders-table')" id="order-search">
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="card">
                <div class="table-wrapper">
                    <table id="orders-table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Update Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $o):
                                $badgeMap = [
                                    'pending'    => 'badge-warning',
                                    'processing' => 'badge-info',
                                    'shipped'    => 'badge-purple',
                                    'delivered'  => 'badge-success',
                                    'cancelled'  => 'badge-danger',
                                ];
                                $cls = $badgeMap[$o['status']] ?? 'badge-muted';
                            ?>
                            <tr id="order-row-<?= $o['id'] ?>">
                                <td><strong style="color:var(--accent-light);">#<?= $o['id'] ?></strong></td>
                                <td>
                                    <strong><?= htmlspecialchars($o['user_name'] ?? 'Guest') ?></strong>
                                    <div class="td-muted"><?= htmlspecialchars($o['user_email'] ?? '—') ?></div>
                                </td>
                                <td><strong>$<?= number_format($o['total'], 2) ?></strong></td>
                                <td><span class="badge <?= $cls ?>"><?= $o['status'] ?></span></td>
                                <td class="td-muted"><?= date('M d, Y', strtotime($o['created_at'])) ?></td>
                                <td>
                                    <select class="form-control" style="max-width:160px;padding:6px 10px;"
                                            onchange="updateOrderStatus(<?= $o['id'] ?>, this.value, this)">
                                        <?php foreach ($statusOptions as $s): ?>
                                            <option value="<?= $s ?>" <?= $o['status'] === $s ? 'selected' : '' ?>>
                                                <?= ucfirst($s) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if (empty($orders)): ?>
                        <div class="empty-state">
                            <i class="fas fa-shopping-cart"></i>
                            <p>No orders found<?= $filter ? " with status '$filter'" : '' ?>.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toast-container"></div>

<script src="assets/js/admin.js"></script>
<script>
async function updateOrderStatus(id, status, selectEl) {
    selectEl.disabled = true;
    const res = await apiFetch('../Backend/admin/orders.php', {
        method: 'PUT',
        body: JSON.stringify({ id, status }),
    });
    selectEl.disabled = false;

    if (res.success) {
        showToast(`Order #${id} marked as "${status}".`, 'success');
        // Update badge in the row
        const row  = document.getElementById('order-row-' + id);
        const badgeMap = {
            pending:'badge-warning', processing:'badge-info',
            shipped:'badge-purple',  delivered:'badge-success', cancelled:'badge-danger'
        };
        const badge = row.querySelector('.badge');
        if (badge) {
            badge.className = 'badge ' + (badgeMap[status] || 'badge-muted');
            badge.textContent = status;
        }
    } else {
        showToast(res.message, 'error');
    }
}
</script>
</body>
</html>
