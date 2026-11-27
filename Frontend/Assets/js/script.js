/* ================================================
   Nova E-Commerce — Main Script
   ================================================ */

/* ---- Cart Data (localStorage) ---- */
function getCart() {
    const data = localStorage.getItem('novaCart');
    return data ? JSON.parse(data) : [];
}

function saveCart(cart) {
    localStorage.setItem('novaCart', JSON.stringify(cart));
    updateCartCount();
}

function updateCartCount() {
    const cart = getCart();
    const total = cart.reduce((sum, item) => sum + item.qty, 0);
    const badge = document.getElementById('cart-count');
    if (badge) {
        badge.textContent = total;
        badge.style.display = total > 0 ? 'flex' : 'none';
    }
}

/* ---- Add To Cart ---- */
function addToCart(name, price, image, category) {
    let cart = getCart();
    const existing = cart.find(item => item.name === name);

    if (existing) {
        existing.qty += 1;
    } else {
        cart.push({
            name: name,
            price: parseFloat(price),
            image: image,
            category: category || 'General',
            qty: 1
        });
    }

    saveCart(cart);
    showToast(`"${name}" added to cart!`);
}

/* ---- Toast Notification ---- */
function showToast(message) {
    let toast = document.getElementById('nova-toast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'nova-toast';
        toast.className = 'toast-notification';
        toast.innerHTML = `<i class="fas fa-check-circle"></i><span id="nova-toast-msg"></span>`;
        document.body.appendChild(toast);
    }
    document.getElementById('nova-toast-msg').textContent = message;
    toast.classList.add('show');
    clearTimeout(window._toastTimer);
    window._toastTimer = setTimeout(() => toast.classList.remove('show'), 2800);
}

/* ---- Mobile Menu Toggle ---- */
const bar = document.getElementById('bar-icon');
const navRight = document.getElementById('nav-right');

if (bar && navRight) {
    bar.addEventListener('click', () => {
        navRight.classList.toggle('active');
    });
}

/* ---- Search Toggle (fixed) ---- */
function toggleSearch() {
    const input = document.getElementById('searchInput');
    if (!input) return;

    if (input.style.display === 'block') {
        input.style.display = 'none';
    } else {
        input.style.display = 'block';
        setTimeout(() => input.focus(), 50);
    }
}

/* ---- Product Search (shop page) ---- */
const searchInput = document.getElementById('searchInput');
if (searchInput) {
    searchInput.addEventListener('input', function () {
        const val = this.value.toLowerCase().trim();
        const cards = document.querySelectorAll('.product');
        cards.forEach(card => {
            const name = card.querySelector('h3') ? card.querySelector('h3').textContent.toLowerCase() : '';
            card.style.display = name.includes(val) ? '' : 'none';
        });
    });
}

/* ---- Shop Filter Buttons & Category Filtering ---- */
function initShopFilters() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const productItems = document.querySelectorAll('.product');
    const visibleCountEl = document.getElementById('visible-count');

    if (filterBtns.length === 0 || productItems.length === 0) return;

    function applyFilter(filterName) {
        let visibleCount = 0;
        const targetFilter = filterName.toLowerCase().trim();

        filterBtns.forEach(b => {
            if (b.dataset.filter.toLowerCase() === targetFilter) {
                b.classList.add('active');
            } else {
                b.classList.remove('active');
            }
        });

        productItems.forEach(product => {
            const cat = (product.dataset.category || '').toLowerCase().trim();
            if (targetFilter === 'all' || cat === targetFilter) {
                product.style.display = '';
                visibleCount++;
            } else {
                product.style.display = 'none';
            }
        });

        if (visibleCountEl) {
            visibleCountEl.textContent = visibleCount;
        }
    }

    filterBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const filter = btn.dataset.filter;
            applyFilter(filter);
        });
    });

    // Check URL query parameter (e.g. shop.php?category=shoes)
    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');
    if (categoryParam) {
        applyFilter(categoryParam);
    }
}

/* ---- Cart Page Rendering ---- */
function renderCartPage() {
    const list = document.getElementById('cart-items-list');
    if (!list) return;

    const cart = getCart();
    const subtotalEl  = document.getElementById('cart-subtotal');
    const shippingEl  = document.getElementById('cart-shipping');
    const totalEl     = document.getElementById('cart-total');
    const summaryBox  = document.getElementById('cart-summary-box');
    const emptyBox    = document.getElementById('cart-empty');
    const itemsBox    = document.getElementById('cart-items-box');
    const itemsCount  = document.getElementById('cart-items-count');

    if (cart.length === 0) {
        if (emptyBox)  emptyBox.style.display  = 'block';
        if (itemsBox)  itemsBox.style.display  = 'none';
        if (summaryBox) summaryBox.style.display = 'none';
        return;
    }

    if (emptyBox)  emptyBox.style.display  = 'none';
    if (itemsBox)  itemsBox.style.display  = 'block';
    if (summaryBox) summaryBox.style.display = 'block';

    if (itemsCount) itemsCount.textContent = cart.reduce((s,i) => s + i.qty, 0) + ' items';

    list.innerHTML = '';

    cart.forEach((item, index) => {
        const row = document.createElement('div');
        row.className = 'cart-item';
        row.innerHTML = `
            <img class="cart-item-img" src="${item.image}" alt="${item.name}" onerror="this.src='Assets/img/nova1.png'">
            <div class="cart-item-details">
                <div class="cart-item-name">${item.name}</div>
                <div class="cart-item-category">${item.category}</div>
                <div class="cart-item-price">$${(item.price * item.qty).toFixed(2)}</div>
            </div>
            <div class="cart-item-right">
                <div class="qty-control">
                    <button class="qty-btn" onclick="changeQty(${index}, -1)">−</button>
                    <input class="qty-value" value="${item.qty}" readonly>
                    <button class="qty-btn" onclick="changeQty(${index}, 1)">+</button>
                </div>
                <button class="remove-btn" onclick="removeItem(${index})" title="Remove">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        list.appendChild(row);
    });

    const subtotal = cart.reduce((s, i) => s + i.price * i.qty, 0);
    const shipping  = subtotal > 100 ? 0 : 9.99;
    const total     = subtotal + shipping;

    if (subtotalEl) subtotalEl.textContent = `$${subtotal.toFixed(2)}`;
    if (shippingEl) shippingEl.textContent = shipping === 0 ? 'FREE' : `$${shipping.toFixed(2)}`;
    if (totalEl)    totalEl.textContent    = `$${total.toFixed(2)}`;
}

function changeQty(index, delta) {
    let cart = getCart();
    cart[index].qty += delta;
    if (cart[index].qty <= 0) cart.splice(index, 1);
    saveCart(cart);
    renderCartPage();
}

function removeItem(index) {
    let cart = getCart();
    const name = cart[index].name;
    cart.splice(index, 1);
    saveCart(cart);
    renderCartPage();
    showToast(`"${name}" removed from cart`);
}

function clearCart() {
    if (confirm('Clear all items from your cart?')) {
        saveCart([]);
        renderCartPage();
    }
}

/* ---- Init ---- */
document.addEventListener('DOMContentLoaded', () => {
    updateCartCount();
    renderCartPage();
    initShopFilters();
});

// Also run on load in case DOMContentLoaded already fired (header include order)
updateCartCount();
renderCartPage();
initShopFilters();