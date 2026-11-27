<?php
/**
 * Admin/users.php — User Management
 */
require_once 'includes/auth_check.php';
require_once '../Backend/config/db.php';

$db    = getDB();
$users = $db->query("SELECT id, name, email, role, status, created_at FROM users ORDER BY created_at DESC")->fetchAll();

$totalUsers  = count(array_filter($users, fn($u) => $u['role'] === 'user'));
$totalAdmins = count(array_filter($users, fn($u) => $u['role'] === 'admin'));
$banned      = count(array_filter($users, fn($u) => $u['status'] === 'banned'));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users — Nova Admin</title>
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
                    <h1 class="page-title">User <span>Management</span></h1>
                    <p class="page-subtitle"><?= count($users) ?> registered accounts</p>
                </div>
            </div>

            <!-- Mini Stats -->
            <div class="stats-grid" style="grid-template-columns:repeat(3,1fr); margin-bottom:24px;">
                <div class="stat-card" style="--card-color:#60a5fa;--card-bg:rgba(59,130,246,.12);">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-info">
                        <div class="stat-value"><?= $totalUsers ?></div>
                        <div class="stat-label">Customers</div>
                    </div>
                </div>
                <div class="stat-card" style="--card-color:#a78bfa;--card-bg:rgba(124,58,237,.12);">
                    <div class="stat-icon"><i class="fas fa-user-shield"></i></div>
                    <div class="stat-info">
                        <div class="stat-value"><?= $totalAdmins ?></div>
                        <div class="stat-label">Admins</div>
                    </div>
                </div>
                <div class="stat-card" style="--card-color:#f87171;--card-bg:rgba(239,68,68,.12);">
                    <div class="stat-icon"><i class="fas fa-ban"></i></div>
                    <div class="stat-info">
                        <div class="stat-value"><?= $banned ?></div>
                        <div class="stat-label">Banned</div>
                    </div>
                </div>
            </div>

            <!-- Search -->
            <div class="card" style="margin-bottom:20px;">
                <div class="card-body" style="padding:14px 20px;">
                    <div class="search-input-wrap" style="max-width:360px;">
                        <i class="fas fa-search"></i>
                        <input type="text" id="user-search" placeholder="Search by name or email..."
                               oninput="filterTable('user-search','users-table')">
                    </div>
                </div>
            </div>

            <!-- Users Table -->
            <div class="card">
                <div class="table-wrapper">
                    <table id="users-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u):
                                $isSelf = (int)$u['id'] === (int)$_SESSION['user_id'];
                            ?>
                            <tr id="user-row-<?= $u['id'] ?>">
                                <td class="td-muted">#<?= $u['id'] ?></td>
                                <td>
                                    <div style="display:flex;align-items:center;gap:10px;">
                                        <div class="admin-avatar" style="width:36px;height:36px;flex-shrink:0;">
                                            <i class="fas <?= $u['role'] === 'admin' ? 'fa-user-shield' : 'fa-user' ?>" style="font-size:.75rem;"></i>
                                        </div>
                                        <strong><?= htmlspecialchars($u['name']) ?>
                                            <?php if ($isSelf): ?>
                                                <span class="badge badge-purple" style="margin-left:4px;font-size:.6rem;">You</span>
                                            <?php endif; ?>
                                        </strong>
                                    </div>
                                </td>
                                <td class="td-muted"><?= htmlspecialchars($u['email']) ?></td>
                                <td>
                                    <span id="role-badge-<?= $u['id'] ?>" class="badge <?= $u['role'] === 'admin' ? 'badge-purple' : 'badge-muted' ?>">
                                        <i class="fas <?= $u['role'] === 'admin' ? 'fa-shield-alt' : 'fa-user' ?>"></i>
                                        <?= $u['role'] ?>
                                    </span>
                                </td>
                                <td>
                                    <span id="status-badge-<?= $u['id'] ?>" class="badge <?= $u['status'] === 'active' ? 'badge-success' : 'badge-danger' ?>">
                                        <?= $u['status'] ?>
                                    </span>
                                </td>
                                <td class="td-muted"><?= date('M d, Y', strtotime($u['created_at'])) ?></td>
                                <td>
                                    <?php if (!$isSelf): ?>
                                    <div style="display:flex;gap:6px;flex-wrap:wrap;">
                                        <?php if ($u['role'] === 'user'): ?>
                                            <button class="btn btn-outline btn-sm" onclick="updateUser(<?= $u['id'] ?>,'role','admin')" title="Promote to Admin">
                                                <i class="fas fa-shield-alt"></i> Make Admin
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-outline btn-sm" onclick="updateUser(<?= $u['id'] ?>,'role','user')" title="Demote to User">
                                                <i class="fas fa-user"></i> Make User
                                            </button>
                                        <?php endif; ?>

                                        <?php if ($u['status'] === 'active'): ?>
                                            <button class="btn btn-danger-outline btn-sm" onclick="updateUser(<?= $u['id'] ?>,'status','banned')">
                                                <i class="fas fa-ban"></i> Ban
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-outline btn-sm" onclick="updateUser(<?= $u['id'] ?>,'status','active')">
                                                <i class="fas fa-check"></i> Unban
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                    <?php else: ?>
                                        <span class="td-muted">—</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if (empty($users)): ?>
                        <div class="empty-state"><i class="fas fa-users"></i><p>No users registered yet.</p></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="toast-container"></div>

<script src="assets/js/admin.js"></script>
<script>
async function updateUser(id, field, value) {
    const res = await apiFetch('../Backend/admin/users.php', {
        method: 'PUT',
        body: JSON.stringify({ id, field, value }),
    });

    if (res.success) {
        showToast(res.message, 'success');
        // Update badge
        if (field === 'role') {
            const badge = document.getElementById('role-badge-' + id);
            badge.className = 'badge ' + (value === 'admin' ? 'badge-purple' : 'badge-muted');
            badge.innerHTML = `<i class="fas ${value === 'admin' ? 'fa-shield-alt' : 'fa-user'}"></i> ${value}`;
        } else {
            const badge = document.getElementById('status-badge-' + id);
            badge.className = 'badge ' + (value === 'active' ? 'badge-success' : 'badge-danger');
            badge.textContent = value;
        }
        // Reload to update buttons
        setTimeout(() => location.reload(), 800);
    } else {
        showToast(res.message, 'error');
    }
}
</script>
</body>
</html>
