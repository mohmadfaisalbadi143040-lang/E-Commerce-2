<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart — Nova Store</title>
    <meta name="description" content="Review your cart items and proceed to checkout at Nova Store.">
    <link rel="stylesheet" href="Assets/css/style.css">
    <?php include 'header.php'; ?>
</head>

<body>

    <section class="cart-page">
        <h1><i class="fas fa-shopping-bag" style="color:var(--primary);margin-right:14px;"></i>Your Cart</h1>

        <!-- Empty Cart State -->
        <div id="cart-empty" style="display:none;">
            <div class="empty-cart">
                <i class="fas fa-bag-shopping"></i>
                <h3>Your cart is empty</h3>
                <p>Looks like you haven't added anything yet. Start shopping!</p>
                <a href="shop.php" class="shop-btn">Browse Products</a>
            </div>
        </div>

        <!-- Cart Content -->
        <div class="cart-layout" id="cart-summary-box" style="display:none;">

            <!-- Items Column -->
            <div class="cart-items-box" id="cart-items-box">
                <div class="cart-items-header">
                    <h3>Cart Items &nbsp;<small id="cart-items-count" style="color:var(--text-muted);font-weight:400;font-size:14px;"></small></h3>
                    <button class="clear-cart-btn" onclick="clearCart()">
                        <i class="fas fa-trash" style="margin-right:5px;"></i> Clear All
                    </button>
                </div>
                <div id="cart-items-list"></div>
            </div>

            <!-- Order Summary Column -->
            <div class="order-summary">
                <h3>Order Summary</h3>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span id="cart-subtotal">$0.00</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span id="cart-shipping">$9.99</span>
                </div>
                <div class="summary-row">
                    <span style="color:var(--primary);font-size:13px;font-weight:600;">✓ Free shipping on orders over $100</span>
                    <span></span>
                </div>

                <div class="summary-divider"></div>

                <div class="summary-total">
                    <span>Total</span>
                    <span id="cart-total">$0.00</span>
                </div>

                <button class="checkout-btn" onclick="openCheckoutModal()">
                    <i class="fas fa-lock" style="margin-right:8px;"></i>Secure Checkout
                </button>
                <a href="shop.php" class="continue-btn">Continue Shopping</a>

                <!-- Promo Code -->
                <div class="promo-box">
                    <input type="text" placeholder="Promo code" id="promo-input">
                    <button onclick="showToast('Promo code applied!')">Apply</button>
                </div>

                <!-- Trust Badges -->
                <div class="trust-badges">
                    <div class="badge-item">
                        <i class="fas fa-shield-halved"></i>
                        Secure Pay
                    </div>
                    <div class="badge-item">
                        <i class="fas fa-truck"></i>
                        Fast Ship
                    </div>
                    <div class="badge-item">
                        <i class="fas fa-rotate-left"></i>
                        Easy Return
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Checkout Modal -->
    <div id="checkout-modal" class="checkout-modal-backdrop" style="display:none;">
        <div class="checkout-modal-card">
            <button onclick="closeCheckoutModal()" class="checkout-modal-close">&times;</button>
            
            <h2 class="checkout-modal-title"><i class="fas fa-shield-alt"></i> Secure Checkout</h2>
            <p class="checkout-modal-subtitle">Complete your delivery details to place the order</p>

            <?php if (!$loggedIn): ?>
                <div class="checkout-alert-login">
                    <h4><i class="fas fa-user-lock" style="color:var(--primary);margin-right:6px;"></i> Sign In Required</h4>
                    <p>Please login to your Nova account to complete your purchase and track your order in real-time.</p>
                    <a href="login.php" class="checkout-login-btn">Sign In / Register Now →</a>
                </div>
            <?php else: ?>
                <div id="checkout-msg" style="display:none; padding:10px 14px; border-radius:8px; font-size:.85rem; margin-bottom:14px;"></div>

                <form id="checkout-form" onsubmit="processOrder(event)">
                    <div class="checkout-form-grid">
                        <div class="checkout-form-group">
                            <label for="chk-name">Full Name</label>
                            <input type="text" id="chk-name" value="<?= htmlspecialchars($_SESSION['user_name'] ?? '') ?>" required>
                        </div>
                        <div class="checkout-form-group">
                            <label for="chk-email">Email Address</label>
                            <input type="email" id="chk-email" value="<?= htmlspecialchars($_SESSION['user_email'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="checkout-form-group">
                        <label for="chk-phone">Phone Number</label>
                        <input type="tel" id="chk-phone" placeholder="+91 98765 43210" required>
                    </div>

                    <div class="checkout-form-group">
                        <label for="chk-address">Delivery Address</label>
                        <textarea id="chk-address" rows="2" placeholder="House/Flat No., Street, City, Pincode" required></textarea>
                    </div>

                    <div class="checkout-summary-box">
                        <div class="checkout-summary-row">
                            <span>Payment Method:</span>
                            <strong style="color:var(--dark);"><i class="fas fa-money-bill-wave" style="color:var(--primary);margin-right:4px;"></i> Cash on Delivery / Pay Online</strong>
                        </div>
                        <div class="checkout-summary-row checkout-summary-total">
                            <span>Total Payable:</span>
                            <span id="chk-total-amount">$0.00</span>
                        </div>
                    </div>

                    <button type="submit" id="chk-submit-btn" class="checkout-submit-btn">
                        <i class="fas fa-check-circle"></i> Confirm & Place Order
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Order Success Modal -->
    <div id="success-modal" class="checkout-modal-backdrop" style="display:none;">
        <div class="checkout-modal-card" style="text-align:center; max-width:480px;">
            <div class="order-success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h2 style="font-size:26px; font-weight:800; color:var(--dark); margin-bottom:8px;">Order Placed! 🎉</h2>
            <p style="font-size:14px; color:var(--text-muted); margin-bottom:20px;">Thank you for shopping at Nova Store. Your order has been registered in the system.</p>
            
            <div class="checkout-summary-box" style="text-align:left; font-size:14px;">
                <div class="checkout-summary-row">
                    <span style="color:var(--text-muted);">Order ID:</span>
                    <strong id="succ-order-id" style="color:var(--primary);">#1001</strong>
                </div>
                <div class="checkout-summary-row">
                    <span style="color:var(--text-muted);">Total Amount:</span>
                    <strong id="succ-total-amount" style="color:var(--dark);">$0.00</strong>
                </div>
                <div class="checkout-summary-row">
                    <span style="color:var(--text-muted);">Order Status:</span>
                    <span style="color:#d97706; font-weight:700;"><i class="fas fa-clock"></i> Pending Processing</span>
                </div>
            </div>

            <a href="shop.php" onclick="closeSuccessModal()" class="checkout-submit-btn" style="text-decoration:none; margin-top:10px;">
                Continue Shopping →
            </a>
        </div>
    </div>

    <script>
    function openCheckoutModal() {
        const cart = getCart();
        if (cart.length === 0) {
            showToast("Your cart is empty!");
            return;
        }

        const subtotal = cart.reduce((s, i) => s + i.price * i.qty, 0);
        const shipping = subtotal > 100 ? 0 : 9.99;
        const total = subtotal + shipping;

        const totalEl = document.getElementById('chk-total-amount');
        if (totalEl) totalEl.textContent = `$${total.toFixed(2)}`;

        const modal = document.getElementById('checkout-modal');
        if (modal) modal.style.display = 'flex';
    }

    function closeCheckoutModal() {
        const modal = document.getElementById('checkout-modal');
        if (modal) modal.style.display = 'none';
    }

    function closeSuccessModal() {
        const modal = document.getElementById('success-modal');
        if (modal) modal.style.display = 'none';
    }

    async function processOrder(e) {
        e.preventDefault();
        const btn = document.getElementById('chk-submit-btn');
        const msgEl = document.getElementById('checkout-msg');
        
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing Order...';
        if (msgEl) msgEl.style.display = 'none';

        const cart = getCart();
        const payload = {
            items: cart,
            phone: document.getElementById('chk-phone') ? document.getElementById('chk-phone').value : '',
            address: document.getElementById('chk-address') ? document.getElementById('chk-address').value : '',
        };

        try {
            const res = await fetch('../Backend/orders/create.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload),
            });
            const json = await res.json();

            if (json.success) {
                closeCheckoutModal();
                // Clear cart
                saveCart([]);
                renderCartPage();

                // Show success modal
                document.getElementById('succ-order-id').textContent = '#' + json.order_id;
                document.getElementById('succ-total-amount').textContent = '$' + json.total;
                document.getElementById('success-modal').style.display = 'flex';
            } else {
                if (msgEl) {
                    msgEl.style.cssText = 'display:block; background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.3); color:#e53935;';
                    msgEl.textContent = json.message;
                }
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-check-circle"></i> Confirm & Place Order';
            }
        } catch (err) {
            if (msgEl) {
                msgEl.style.cssText = 'display:block; background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.3); color:#e53935;';
                msgEl.textContent = 'Connection error. Please try again.';
            }
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-check-circle"></i> Confirm & Place Order';
        }
    }
    </script>

    <?php include 'footer.php'; ?>

</body>
</html>
