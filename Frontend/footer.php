<?php
// footer.php — shared footer include for all pages
if (session_status() === PHP_SESSION_NONE) session_start();
$adminLink = (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') ? '../Admin/index.php' : '../Admin/login.php';
?>
<footer class="section-p2">
    <div class="col">
        <a href="index.php">
            <img class="logo" src="Assets/img/nova1.png" alt="Nova Logo">
        </a>
        <h4>Contact</h4>
        <p><strong>Address:</strong> Gujarat,Wankaner - 363621, India</p>
        <!-- <p><strong>Phone:</strong> +91 8160555710</p> -->
        <div class="follow">
            <h4>Follow Us</h4>
            <div class="icon">
                <a href="https://github.com/BadiFaisal486?tab=repositories"><i class="fa-brands fa-github"></i></a>
                <!-- <a href="https://www.instagram.com/faisal_badi_/"><i class="fab fa-instagram"></i></a> -->
                <a href="https://www.linkedin.com/in/badi-faisal-11a984367/"><i class="fa-brands fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    <div class="col">
        <h4>About</h4>
        <a href="about.php">About Us</a>
        <a href="#">Delivery Information</a>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms &amp; Conditions</a>
        <a href="contact.php">Contact Us</a>
    </div>

    <div class="col">
        <h4>My Account</h4>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
        <a href="cart.php">View Cart</a>
        <a href="#">My Wishlist</a>
        <a href="#">Track My Order</a>
        <a href="<?= $adminLink ?>" class="admin-portal-link"><i class="fa-solid fa-shield-halved"></i> Admin Portal</a>
    </div>

    <div class="col">
        <h4>Categories</h4>
        <a href="shop.php">All Products</a>
        <a href="shop.php?cat=shoes">Shoes</a>
        <a href="shop.php?cat=headphones">Headphones</a>
        <a href="shop.php?cat=watches">Watches</a>
        <a href="shop.php?cat=electronics">Electronics</a>
    </div>

    <div class="copyright">
        <p>© 2026 Nova Store — Built by <strong>Faisal Badi</strong></p>
    </div>
</footer>