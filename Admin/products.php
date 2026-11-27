<?php
/**
 * Admin/products.php — Product Management (CRUD)
 */
require_once 'includes/auth_check.php';
require_once '../Backend/config/db.php';

$db         = getDB();
$categories = ['Shoes','Headphones','Watches','Electronics','Clothing','Accessories'];

// Pre-load products for initial render (JS fetches updates live)
$products   = $db->query("SELECT * FROM products ORDER BY created_at DESC")->fetchAll();
$autoOpen   = ($_GET['action'] ?? '') === 'add' ? 'true' : 'false';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products — Nova Admin</title>
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
                    <h1 class="page-title">Product <span>Management</span></h1>
                    <p class="page-subtitle"><?= count($products) ?> products in catalog</p>
                </div>
                <button class="btn btn-primary" onclick="openModal('product-modal'); setModalMode('add')">
                    <i class="fas fa-plus"></i> Add Product
                </button>
            </div>

            <!-- Filter Bar -->
            <div class="card" style="margin-bottom:20px;">
                <div class="card-body" style="padding:14px 20px;">
                    <div class="search-bar">
                        <div class="search-input-wrap" style="max-width:340px;">
                            <i class="fas fa-search"></i>
                            <input type="text" id="prod-search" placeholder="Search products..." oninput="filterTable('prod-search','products-table')">
                        </div>
                        <select class="form-control" style="max-width:160px;" onchange="filterCategory(this.value)">
                            <option value="">All Categories</option>
                            <?php foreach ($categories as $cat): ?>
                                <option><?= $cat ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Products Table -->
            <div class="card">
                <div class="table-wrapper">
                    <table id="products-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Featured</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="products-tbody">
                            <?php foreach ($products as $p): ?>
                            <tr data-id="<?= $p['id'] ?>" data-category="<?= htmlspecialchars($p['category']) ?>">
                                <td class="td-muted">#<?= $p['id'] ?></td>
                                <td>
                                    <img src="../<?= htmlspecialchars($p['image']) ?>"
                                         onerror="this.src='assets/img/no-image.png'"
                                         class="product-thumb" alt="<?= htmlspecialchars($p['name']) ?>">
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($p['name']) ?></strong>
                                    <?php if ($p['discount']): ?>
                                        <span class="badge badge-warning" style="margin-left:6px;">-<?= $p['discount'] ?>%</span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge badge-muted"><?= htmlspecialchars($p['category']) ?></span></td>
                                <td>
                                    <strong>$<?= number_format($p['price'], 2) ?></strong>
                                    <?php if ($p['old_price']): ?>
                                        <br><small class="td-muted" style="text-decoration:line-through;">$<?= number_format($p['old_price'], 2) ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge <?= $p['stock'] < 10 ? 'badge-danger' : ($p['stock'] < 30 ? 'badge-warning' : 'badge-success') ?>">
                                        <?= $p['stock'] ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge <?= $p['featured'] ? 'badge-purple' : 'badge-muted' ?>">
                                        <?= $p['featured'] ? '★ Yes' : 'No' ?>
                                    </span>
                                </td>
                                <td>
                                    <div style="display:flex;gap:6px;">
                                        <button class="btn btn-outline btn-sm btn-icon" title="Edit"
                                            onclick="editProduct(<?= htmlspecialchars(json_encode($p)) ?>)">
                                            <i class="fas fa-pen"></i>
                                        </button>
                                        <button class="btn btn-danger-outline btn-sm btn-icon" title="Delete"
                                            onclick="deleteProduct(<?= $p['id'] ?>, this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php if (empty($products)): ?>
                        <div class="empty-state"><i class="fas fa-box-open"></i><p>No products yet. Add your first product!</p></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add / Edit Product Modal -->
<div class="modal-overlay" id="product-modal">
    <div class="modal">
        <div class="modal-header">
            <h3 class="modal-title" id="modal-title">Add New Product</h3>
            <button class="modal-close" onclick="closeModal('product-modal')"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="prod-id">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Product Name *</label>
                    <input type="text" class="form-control" id="prod-name" placeholder="e.g. Nike Air Max 270">
                </div>
                <div class="form-group">
                    <label class="form-label">Category *</label>
                    <select class="form-control" id="prod-category">
                        <?php foreach ($categories as $cat): ?>
                            <option><?= $cat ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Price ($) *</label>
                    <input type="number" class="form-control" id="prod-price" placeholder="149.99" min="0" step="0.01">
                </div>
                <div class="form-group">
                    <label class="form-label">Old Price ($)</label>
                    <input type="number" class="form-control" id="prod-old-price" placeholder="199.99" min="0" step="0.01">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Discount (%)</label>
                    <input type="number" class="form-control" id="prod-discount" placeholder="25" min="0" max="100">
                </div>
                <div class="form-group">
                    <label class="form-label">Stock Quantity</label>
                    <input type="number" class="form-control" id="prod-stock" placeholder="50" min="0">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Image Path (relative to project root)</label>
                <input type="text" class="form-control" id="prod-image" placeholder="Frontend/Assets/img/product.jpg">
            </div>
            <div class="form-group">
                <label class="form-label">
                    <input type="checkbox" id="prod-featured" style="margin-right:6px;">
                    Mark as Featured Product
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-outline" onclick="closeModal('product-modal')">Cancel</button>
            <button class="btn btn-primary" id="save-product-btn" onclick="saveProduct()">
                <i class="fas fa-save"></i> Save Product
            </button>
        </div>
    </div>
</div>

<div class="toast-container"></div>

<script src="assets/js/admin.js"></script>
<script>
const API = '../Backend/admin/products.php';

function setModalMode(mode, data = {}) {
    document.getElementById('modal-title').textContent = mode === 'add' ? 'Add New Product' : 'Edit Product';
    document.getElementById('save-product-btn').innerHTML = mode === 'add'
        ? '<i class="fas fa-plus"></i> Add Product'
        : '<i class="fas fa-save"></i> Update Product';
    document.getElementById('prod-id').value        = data.id        || '';
    document.getElementById('prod-name').value      = data.name      || '';
    document.getElementById('prod-price').value     = data.price     || '';
    document.getElementById('prod-old-price').value = data.old_price || '';
    document.getElementById('prod-discount').value  = data.discount  || '';
    document.getElementById('prod-stock').value     = data.stock     || '';
    document.getElementById('prod-image').value     = data.image     || '';
    document.getElementById('prod-featured').checked = !!parseInt(data.featured);
    document.getElementById('prod-category').value  = data.category  || 'Shoes';
}

function editProduct(data) {
    openModal('product-modal');
    setModalMode('edit', data);
}

async function saveProduct() {
    const id = document.getElementById('prod-id').value;
    const payload = {
        id:        id ? parseInt(id) : undefined,
        name:      document.getElementById('prod-name').value.trim(),
        category:  document.getElementById('prod-category').value,
        price:     parseFloat(document.getElementById('prod-price').value),
        old_price: parseFloat(document.getElementById('prod-old-price').value) || null,
        discount:  parseInt(document.getElementById('prod-discount').value) || 0,
        stock:     parseInt(document.getElementById('prod-stock').value) || 0,
        image:     document.getElementById('prod-image').value.trim(),
        featured:  document.getElementById('prod-featured').checked ? 1 : 0,
    };

    if (!payload.name || !payload.price) {
        showToast('Name and price are required.', 'error');
        return;
    }

    const method = id ? 'PUT' : 'POST';
    const res    = await apiFetch(API, { method, body: JSON.stringify(payload) });

    if (res.success) {
        showToast(res.message, 'success');
        closeModal('product-modal');
        setTimeout(() => location.reload(), 800);
    } else {
        showToast(res.message, 'error');
    }
}

async function deleteProduct(id, btn) {
    if (!confirm('Delete this product? This cannot be undone.')) return;
    btn.closest('tr').style.opacity = '.4';
    const res = await apiFetch(API, { method: 'DELETE', body: JSON.stringify({ id }) });
    if (res.success) {
        showToast('Product deleted.', 'success');
        btn.closest('tr').remove();
    } else {
        showToast(res.message, 'error');
        btn.closest('tr').style.opacity = '1';
    }
}

function filterCategory(cat) {
    const rows = document.querySelectorAll('#products-tbody tr');
    rows.forEach(row => {
        const rowCat = row.dataset.category || '';
        row.style.display = (!cat || rowCat === cat) ? '' : 'none';
    });
}

// Auto-open modal if ?action=add
if (<?= $autoOpen ?>) {
    openModal('product-modal');
    setModalMode('add');
}
</script>
</body>
</html>
