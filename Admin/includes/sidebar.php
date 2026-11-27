<?php
/**
 * Admin/includes/sidebar.php
 */
$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="fas fa-bolt"></i>
        </div>
        <div class="brand-text">
            <span class="brand-name">Nova</span>
            <span class="brand-sub">Admin Panel</span>
        </div>
    </div>

    <nav class="sidebar-nav">
        <div class="nav-section-title">MAIN</div>
        <a href="index.php" class="nav-item <?= $currentPage === 'index' ? 'active' : '' ?>">
            <i class="fas fa-th-large"></i>
            <span>Dashboard</span>
        </a>
        <a href="products.php" class="nav-item <?= $currentPage === 'products' ? 'active' : '' ?>">
            <i class="fas fa-box-open"></i>
            <span>Products</span>
        </a>
        <a href="orders.php" class="nav-item <?= $currentPage === 'orders' ? 'active' : '' ?>">
            <i class="fas fa-shopping-cart"></i>
            <span>Orders</span>
        </a>
        <a href="users.php" class="nav-item <?= $currentPage === 'users' ? 'active' : '' ?>">
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>

        <div class="nav-section-title" style="margin-top:24px;">STORE</div>
        <a href="../Frontend/index.php" class="nav-item" target="_blank">
            <i class="fas fa-store"></i>
            <span>View Store</span>
        </a>

        <div class="nav-section-title" style="margin-top:24px;">ACCOUNT</div>
        <a href="../Backend/auth/logout.php" class="nav-item nav-logout">
            <i class="fas fa-sign-out-alt"></i>
            <span>Logout</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <div class="admin-avatar">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="admin-info">
            <span class="admin-name"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin') ?></span>
            <span class="admin-role">Administrator</span>
        </div>
    </div>
</aside>
