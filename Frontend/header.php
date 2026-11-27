<?php
// header.php — shared header include for all pages
if (session_status() === PHP_SESSION_NONE) session_start();
$loggedIn  = isset($_SESSION['user_id']);
$isAdmin   = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
$userName  = htmlspecialchars($_SESSION['user_name'] ?? '');
?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<header id="Navbar">
    <div class="left">
        <a href="index.php">
            <img src="Assets/img/nova1.png" alt="Nova Logo">
        </a>
    </div>

    <div class="right" id="nav-right">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if ($isAdmin): ?>
                    <li><a href="../Admin/index.php" style="color:#a78bfa;"><i class="fas fa-shield-alt"></i> Admin</a></li>
                <?php endif; ?>
                <?php if ($loggedIn): ?>
                    <li><a href="../Backend/auth/logout.php" style="color:#f87171;"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <div class="icons">
        <div class="cart-icon" onclick="window.location.href='cart.php'" title="View Cart">
            <i class="fa-solid fa-bag-shopping" id="cart"></i>
            <span id="cart-count">0</span>
        </div>
        <?php if ($loggedIn): ?>
            <span style="font-size:.78rem; color:#a78bfa; font-weight:600; cursor:default;" title="<?= $userName ?>">
                <i class="fas fa-user-check"></i> 
                <!-- <?= $userName ?> -->
            </span>
        <?php else: ?>
            <i class="fa-regular fa-user" id="user" onclick="window.location.href='login.php'" title="Login" style="cursor:pointer;"></i>
        <?php endif; ?>
        <i class="fas fa-magnifying-glass search-icon" onclick="toggleSearch()" title="Search"></i>
        <input type="text" id="searchInput" placeholder="Search products...">
        <i class="fa-solid fa-bars" id="bar-icon"></i>
    </div>
</header>

<script src="Assets/js/script.js"></script>