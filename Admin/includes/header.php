<?php
/**
 * Admin/includes/header.php — Top bar for admin panel
 */
?>
<header class="admin-topbar">
    <div class="topbar-left">
        <button class="sidebar-toggle" onclick="toggleSidebar()" title="Toggle Sidebar">
            <i class="fas fa-bars"></i>
        </button>
        <div class="breadcrumb">
            <span>Nova Admin</span>
            <i class="fas fa-chevron-right"></i>
            <span class="current-page"><?= ucfirst(basename($_SERVER['PHP_SELF'], '.php')) ?></span>
        </div>
    </div>
    <div class="topbar-right">
        <div class="topbar-store-link">
            <a href="../Frontend/index.php" target="_blank" class="store-btn">
                <i class="fas fa-external-link-alt"></i> View Store
            </a>
        </div>
        <div class="topbar-admin">
            <div class="admin-badge">
                <i class="fas fa-user-shield"></i>
                <span><?= htmlspecialchars($_SESSION['user_name'] ?? 'Admin') ?></span>
            </div>
        </div>
    </div>
</header>
