/* ============================================================
   Nova Admin — JavaScript Utilities
   ============================================================ */

// ── Sidebar Toggle ─────────────────────────────────────────────
function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('open');
}

// ── Toast Notifications ────────────────────────────────────────
function showToast(message, type = 'success') {
    let container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container';
        document.body.appendChild(container);
    }

    const icon   = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
    const toast  = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.innerHTML = `<i class="fas ${icon}"></i><span>${message}</span>`;
    container.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        toast.style.transition = '.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// ── Modal Helpers ──────────────────────────────────────────────
function openModal(id) {
    const overlay = document.getElementById(id);
    if (overlay) overlay.classList.add('open');
}

function closeModal(id) {
    const overlay = document.getElementById(id);
    if (overlay) overlay.classList.remove('open');
}

// Close on backdrop click
document.addEventListener('click', (e) => {
    if (e.target.classList.contains('modal-overlay')) {
        e.target.classList.remove('open');
    }
});

// ── Confirm Dialog ─────────────────────────────────────────────
function confirmAction(message, callback) {
    if (window.confirm(message)) callback();
}

// ── Format currency ────────────────────────────────────────────
function formatCurrency(val) {
    return '$' + parseFloat(val).toLocaleString('en-US', { minimumFractionDigits: 2 });
}

// ── Format date ────────────────────────────────────────────────
function formatDate(dateStr) {
    if (!dateStr) return '—';
    const d = new Date(dateStr);
    return d.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
}

// ── Status badge HTML ──────────────────────────────────────────
function statusBadge(status) {
    const map = {
        pending:    ['badge-warning', 'fa-clock'],
        processing: ['badge-info',    'fa-cog'],
        shipped:    ['badge-purple',  'fa-truck'],
        delivered:  ['badge-success', 'fa-check-circle'],
        cancelled:  ['badge-danger',  'fa-times-circle'],
        active:     ['badge-success', 'fa-check-circle'],
        banned:     ['badge-danger',  'fa-ban'],
        admin:      ['badge-purple',  'fa-shield-alt'],
        user:       ['badge-muted',   'fa-user'],
    };
    const [cls, icon] = map[status] || ['badge-muted', 'fa-circle'];
    return `<span class="badge ${cls}"><i class="fas ${icon}"></i> ${status}</span>`;
}

// ── Generic API Fetch ──────────────────────────────────────────
async function apiFetch(url, options = {}) {
    try {
        const res  = await fetch(url, {
            headers: { 'Content-Type': 'application/json' },
            ...options,
        });
        return await res.json();
    } catch (err) {
        showToast('Network error. Please try again.', 'error');
        throw err;
    }
}

// ── Table Search Filter ────────────────────────────────────────
function filterTable(inputId, tableId) {
    const query = document.getElementById(inputId).value.toLowerCase();
    const rows  = document.querySelectorAll(`#${tableId} tbody tr`);
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(query) ? '' : 'none';
    });
}
