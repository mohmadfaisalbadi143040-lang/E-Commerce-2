<?php
/**
 * install.php — One-time Database Setup
 * Visit: http://localhost/E-Commerce%202/Backend/setup/install.php
 *
 * Creates the nova_ecommerce database, all tables, and a default admin user.
 */

// Connect WITHOUT specifying a database first
$host    = 'localhost';
$user    = 'root';
$pass    = '';
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;charset=$charset", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
} catch (PDOException $e) {
    die("❌ Cannot connect to MySQL: " . $e->getMessage());
}

$log = [];

// ── 1. Create database ────────────────────────────────────────────────────────
$pdo->exec("CREATE DATABASE IF NOT EXISTS `nova_ecommerce` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
$pdo->exec("USE `nova_ecommerce`");
$log[] = "✅ Database <strong>nova_ecommerce</strong> ready.";

// ── 2. Users table ────────────────────────────────────────────────────────────
$pdo->exec("
    CREATE TABLE IF NOT EXISTS `users` (
        `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `name`       VARCHAR(120) NOT NULL,
        `email`      VARCHAR(180) NOT NULL UNIQUE,
        `password`   VARCHAR(255) NOT NULL,
        `role`       ENUM('user','admin') NOT NULL DEFAULT 'user',
        `status`     ENUM('active','banned') NOT NULL DEFAULT 'active',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");
$log[] = "✅ Table <strong>users</strong> ready.";

// ── 3. Products table ─────────────────────────────────────────────────────────
$pdo->exec("
    CREATE TABLE IF NOT EXISTS `products` (
        `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `name`       VARCHAR(200) NOT NULL,
        `category`   VARCHAR(80)  NOT NULL,
        `price`      DECIMAL(10,2) NOT NULL,
        `old_price`  DECIMAL(10,2) DEFAULT NULL,
        `discount`   TINYINT UNSIGNED DEFAULT 0,
        `image`      VARCHAR(400) DEFAULT '',
        `stock`      INT UNSIGNED NOT NULL DEFAULT 0,
        `featured`   TINYINT(1) NOT NULL DEFAULT 0,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");
$log[] = "✅ Table <strong>products</strong> ready.";

// ── 4. Orders table ───────────────────────────────────────────────────────────
$pdo->exec("
    CREATE TABLE IF NOT EXISTS `orders` (
        `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `user_id`    INT UNSIGNED DEFAULT NULL,
        `total`      DECIMAL(10,2) NOT NULL,
        `status`     ENUM('pending','processing','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");
$log[] = "✅ Table <strong>orders</strong> ready.";

// ── 5. Order Items table ──────────────────────────────────────────────────────
$pdo->exec("
    CREATE TABLE IF NOT EXISTS `order_items` (
        `id`         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `order_id`   INT UNSIGNED NOT NULL,
        `product_id` INT UNSIGNED DEFAULT NULL,
        `name`       VARCHAR(200) NOT NULL,
        `qty`        TINYINT UNSIGNED NOT NULL DEFAULT 1,
        `price`      DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (`order_id`)   REFERENCES `orders`(`id`)   ON DELETE CASCADE,
        FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");
$log[] = "✅ Table <strong>order_items</strong> ready.";

// ── 6. Seed admin user ────────────────────────────────────────────────────────
$adminEmail = 'admin@nova.com';
$stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$adminEmail]);

if (!$stmt->fetch()) {
    $hash = password_hash('admin123', PASSWORD_BCRYPT);
    $ins  = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'admin')");
    $ins->execute(['Nova Admin', $adminEmail, $hash]);
    $log[] = "✅ Admin user created: <strong>admin@nova.com</strong> / <strong>admin123</strong>";
} else {
    $log[] = "ℹ️ Admin user already exists — skipped.";
}

// ── 7. Seed sample products ───────────────────────────────────────────────────
$stmt = $pdo->query("SELECT COUNT(*) FROM products");
if ((int)$stmt->fetchColumn() === 0) {
    $products = [
        ['Nike Air Max 270',      'Shoes',       149, 199, 25, 'Frontend/Assets/img/2.jpg',                          50, 1],
        ['Adidas Ultra Boost',    'Shoes',       159, 199, 20, 'Frontend/Assets/img/3.jpg',                          40, 1],
        ['Sony WF-1000XM5',       'Headphones',  209, 299, 30, 'Frontend/Assets/img/headphon/budts1.webp',           30, 1],
        ['Bose QuietComfort 45',  'Headphones',  254, 299, 15, 'Frontend/Assets/img/headphon/headphone 1.webp',      25, 0],
        ['JBL Tune 760NC',        'Headphones',   89, 119, 25, 'Frontend/Assets/img/headphon/headphone2.webp',       60, 0],
        ['Apple AirPods Pro 2',   'Headphones',  224, 249, 10, 'Frontend/Assets/img/headphon/headphone3.webp',       45, 1],
        ['Jacob & Co. Luxury',    'Watches',     749, 999, 25, 'Frontend/Assets/img/watch/jacob1.webp',              10, 1],
        ['Classic Chronograph',   'Watches',     399, 499, 20, 'Frontend/Assets/img/watch/jacob2.webp',              15, 0],
        ['Sport Smart Watch Pro', 'Watches',     199, 243, 18, 'Frontend/Assets/img/watch/jacob3.webp',              35, 1],
        ['iPhone 15 Pro Max',     'Electronics',1079,1199, 10, 'Frontend/Assets/img/phonelaptop/iphone1.webp',       20, 1],
        ['iPhone 15 Standard',    'Electronics', 879, 999, 12, 'Frontend/Assets/img/phonelaptop/iphone2.webp',       30, 0],
        ['MacBook Pro M3',        'Electronics',1839,1999,  8, 'Frontend/Assets/img/phonelaptop/macbook1.webp',      12, 1],
        ['MacBook Air M2',        'Electronics',1019,1199, 15, 'Frontend/Assets/img/phonelaptop/macbook2.webp',      18, 0],
        ['Nike Air Force 1',      'Shoes',       112, 150, 25, 'Frontend/Assets/img/shoes/nike1.avif',               55, 0],
        ['Nike React Infinity',   'Shoes',       127, 150, 15, 'Frontend/Assets/img/shoes/nike2.avif',               42, 0],
    ];
    $ins = $pdo->prepare("INSERT INTO products (name, category, price, old_price, discount, image, stock, featured) VALUES (?,?,?,?,?,?,?,?)");
    foreach ($products as $p) {
        $ins->execute($p);
    }
    $log[] = "✅ Seeded <strong>" . count($products) . " products</strong>.";
}

// ── 8. Seed sample orders ─────────────────────────────────────────────────────
$stmt = $pdo->query("SELECT COUNT(*) FROM orders");
if ((int)$stmt->fetchColumn() === 0) {
    $statuses = ['pending','processing','shipped','delivered','cancelled'];
    $adminId  = $pdo->query("SELECT id FROM users WHERE email='admin@nova.com'")->fetchColumn();
    for ($i = 0; $i < 12; $i++) {
        $total  = rand(89, 1839);
        $status = $statuses[array_rand($statuses)];
        $pdo->prepare("INSERT INTO orders (user_id, total, status, created_at) VALUES (?, ?, ?, DATE_SUB(NOW(), INTERVAL ? DAY))")
            ->execute([$adminId, $total, $status, rand(0, 30)]);
    }
    $log[] = "✅ Seeded <strong>12 sample orders</strong>.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Nova — DB Installer</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: 'Segoe UI', sans-serif; background: #0f0f14; color: #e2e8f0; display: flex; align-items: center; justify-content: center; min-height: 100vh; }
  .card { background: #1a1a2e; border: 1px solid #2d2d44; border-radius: 16px; padding: 40px; max-width: 560px; width: 100%; box-shadow: 0 20px 60px rgba(0,0,0,.5); }
  h1 { font-size: 1.6rem; margin-bottom: 6px; color: #a78bfa; }
  .subtitle { color: #64748b; margin-bottom: 28px; font-size: .9rem; }
  .log-item { padding: 10px 14px; border-radius: 8px; background: #0f0f1a; margin-bottom: 10px; border-left: 3px solid #a78bfa; font-size: .9rem; }
  .cta { display: inline-block; margin-top: 24px; padding: 12px 28px; background: linear-gradient(135deg,#7c3aed,#a78bfa); color: #fff; border-radius: 10px; text-decoration: none; font-weight: 600; transition: opacity .2s; }
  .cta:hover { opacity: .85; }
  .warn { margin-top: 16px; padding: 12px 14px; border-radius: 8px; background: rgba(239,68,68,.1); border-left: 3px solid #ef4444; font-size: .85rem; color: #fca5a5; }
</style>
</head>
<body>
<div class="card">
  <h1>🚀 Nova Store — DB Installer</h1>
  <p class="subtitle">Database setup completed successfully</p>
  <?php foreach ($log as $line): ?>
    <div class="log-item"><?= $line ?></div>
  <?php endforeach; ?>
  <div class="warn">⚠️ Delete or restrict access to this file after first run!</div>
  <a href="../../Admin/login.php" class="cta">Go to Admin Panel →</a>
</div>
</body>
</html>
