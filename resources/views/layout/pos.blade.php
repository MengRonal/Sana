<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SK Coffee - POS System</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

  <style>
    :root {
      --sidebar-bg: #2d1e15;
      --sidebar-hover: #3d281e;
      --primary-color: #0d9468;
      --primary-light: #e6f4f0;
      --bg-color: #f8f9fa;
    }

    body {
      background-color: var(--bg-color);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      font-size: 13px;
      overflow-x: hidden;
    }

    /* Layout Structure */
    .app-container {
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
      width: 240px;
      background-color: var(--sidebar-bg);
      color: #b0a8a4;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      position: fixed;
      top: 0;
      bottom: 0;
      left: 0;
      z-index: 1030;
    }

    .sidebar-brand {
      padding: 20px 15px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    }

    .sidebar-menu {
      padding: 15px 10px;
      flex-grow: 1;
      overflow-y: auto;
    }

    .sidebar-link {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 15px;
      color: #b0a8a4;
      text-decoration: none;
      border-radius: 8px;
      margin-bottom: 4px;
      font-weight: 500;
      transition: all 0.2s;
    }

    .sidebar-link:hover,
    .sidebar-link.active {
      background-color: var(--primary-color);
      color: white;
    }

    .sidebar-link i {
      font-size: 16px;
      width: 20px;
      text-align: center;
    }

    .shift-box {
      background: rgba(0, 0, 0, 0.25);
      margin: 15px;
      padding: 12px;
      border-radius: 8px;
      font-size: 12px;
    }

    /* Main Content Wrapper */
    .main-content {
      margin-left: 240px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }

    /* Top Header Navbar */
    .top-navbar {
      background: #ffffff;
      border-bottom: 1px solid #e0e0e0;
      padding: 10px 20px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: 65px;
      position: sticky;
      top: 0;
      z-index: 1020;
    }

    .search-bar-top {
      background: #f1f3f5;
      border-radius: 30px;
      padding: 6px 15px;
      width: 380px;
      display: flex;
      align-items: center;
    }

    .search-bar-top input {
      background: transparent;
      border: none;
      outline: none;
      width: 100%;
      font-size: 13px;
      padding-left: 8px;
    }

    /* Workspace Grid */
    .pos-workspace {
    padding: 20px;
    }
    
    /* Default split layout for POS checkout */
    .pos-workspace.pos-split {
    display: grid;
    grid-template-columns: 420px 1fr;
    gap: 20px;
    }
    
    /* Full-width layout for pages like Customers */
    .pos-workspace.pos-full {
    display: block; /* or grid-template-columns: 1fr; */
    }
    
    @media (max-width: 1200px) {
    .pos-workspace.pos-split {
    grid-template-columns: 1fr;
    }
    }

    /* Cards Styling */
    .card-panel {
      background: #ffffff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
      border: 1px solid #eaeaea;
    }

    /* Current Order Section */
    .order-badge {
      background-color: #fff3cd;
      color: #856404;
      font-size: 11px;
      padding: 3px 10px;
      border-radius: 20px;
      font-weight: 600;
    }

    .cart-table-container {
      max-height: 200px;
      overflow-y: auto;
    }

    .cart-table th {
      font-weight: 500;
      color: #888;
      font-size: 12px;
      background: #f8f9fa;
      border: none;
      position: sticky;
      top: 0;
    }

    .qty-btn {
      width: 22px;
      height: 22px;
      border-radius: 50%;
      border: 1px solid #ced4da;
      background: white;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
      cursor: pointer;
    }

    .qty-btn:hover {
      border-color: var(--primary-color);
      color: var(--primary-color);
    }

    /* Payment Method Selectors */
    .payment-method-btn {
      border: 1px solid #dee2e6;
      border-radius: 8px;
      padding: 8px 12px;
      background: white;
      text-align: center;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s;
      font-size: 12px;
    }

    .payment-method-btn.active {
      border-color: var(--primary-color);
      background-color: var(--primary-light);
      color: var(--primary-color);
    }

    /* Product Catalog */
    .categories-scroll {
      display: flex;
      gap: 10px;
      overflow-x: auto;
      padding-bottom: 5px;
    }

    .category-chip {
      background: white;
      border: 1px solid #e0e0e0;
      border-radius: 10px;
      padding: 8px 16px;
      display: flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      white-space: nowrap;
      font-weight: 500;
      color: #666;
      transition: all 0.2s;
    }

    .category-chip.active {
      border-color: var(--primary-color);
      background-color: var(--primary-light);
      color: var(--primary-color);
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
      gap: 15px;
      max-height: 540px;
      overflow-y: auto;
      padding-right: 5px;
    }

    .product-card {
      background: white;
      border: 1px solid #f0f0f0;
      border-radius: 10px;
      padding: 12px;
      text-align: center;
      cursor: pointer;
      transition: all 0.2s;
      position: relative;
    }

    .product-card:hover {
      border-color: var(--primary-color);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
      transform: translateY(-2px);
    }

    .product-card img {
      height: 85px;
      object-fit: contain;
      margin-bottom: 8px;
      pointer-events: none;
    }

    .product-card .add-badge {
      position: absolute;
      bottom: 10px;
      right: 10px;
      background: var(--primary-light);
      color: var(--primary-color);
      width: 22px;
      height: 22px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 11px;
    }
  </style>
</head>

<body>

  <div class="app-container">
    <!-- Sidebar -->
    <nav class="sidebar">
      <div>
        <div class="sidebar-brand">
          <div class="d-flex align-items-center gap-2">
            <div class="bg-success text-white rounded p-1 d-flex align-items-center justify-content-center"
              style="width:32px; height:32px;">
              <i class="fa-solid fa-mug-hot"></i>
            </div>
            <div>
              <h6 class="m-0 fw-bold text-white" style="font-size:14px;">SK Coffee</h6>
              <small class="text-muted" style="font-size:11px;">Cashier Panel</small>
            </div>
          </div>
        </div>

        <div class="sidebar-menu">
          <a href="{{ route('pos.dashboard') }}" class="sidebar-link active"><i class="fa-solid fa-cash-register"></i> POS</a>
          <a href="#" class="sidebar-link"><i class="fa-solid fa-receipt"></i> Orders</a>
          <a href="{{ route('customer_pos.list') }}" class="sidebar-link"><i class="fa-solid fa-users"></i> Customers</a>
          <a href="#" class="sidebar-link"><i class="fa-solid fa-box-archive"></i> Products</a>
          <a href="#" class="sidebar-link"><i class="fa-solid fa-tags"></i> Offers</a>
          <a href="#" class="sidebar-link"><i class="fa-solid fa-chart-line"></i> Reports</a>
          <a href="#" class="sidebar-link"><i class="fa-solid fa-wallet"></i> Cash Transactions</a>
          <a href="#" class="sidebar-link"><i class="fa-solid fa-gear"></i> Settings</a>
        </div>
      </div>

      <!-- Current Shift Box -->
      <div class="shift-box">
        <div class="d-flex justify-content-between align-items-center mb-1">
          <span class="text-white fw-semibold">Current Shift</span>
          <span class="badge bg-success bg-opacity-25 text-success" style="font-size: 10px;">● Open</span>
        </div>
        <div class="d-flex justify-content-between text-muted mb-1" style="font-size: 11px;">
          <span>Start Time</span>
          <span class="text-white">08:00 AM</span>
        </div>
        <div class="d-flex justify-content-between text-muted mb-2" style="font-size: 11px;">
          <span>Cash in Hand</span>
          <span class="text-white">$200.00</span>
        </div>
        <button class="btn btn-light btn-sm w-100 fw-semibold text-dark" style="font-size:11px;">End Shift</button>
      </div>
    </nav>

    <!-- Main Content Area -->
    <div class="main-content">
      <!-- Top Navigation -->
      <header class="top-navbar">
        <div class="search-bar-top">
          <i class="fa-solid fa-magnifying-glass text-muted"></i>
          <input type="text" id="searchInput" placeholder="Search product by name or code...">
        </div>

        <div class="d-flex align-items-center gap-4">
          <div class="d-flex align-items-center gap-2 border-end pe-4">
            <span class="text-muted" style="font-size: 12px;">Order</span>
            <span class="fw-bold text-dark">#105</span>
          </div>
          <div class="d-flex align-items-center gap-2 text-muted" style="font-size: 12px;">
            <i class="fa-regular fa-clock fs-5"></i>
            <div>
              <div class="fw-bold text-dark">10:30 AM</div>
              <div style="font-size: 10px;">May 22, 2026</div>
            </div>
          </div>
          <div class="d-flex align-items-center gap-2 border-start ps-4">
            <img src="https://i.pravatar.cc/40?img=68" class="rounded-circle" width="36" height="36" alt="User">
            <div>
              <h6 class="m-0 fw-bold" style="font-size: 13px;">Cashier User</h6>
              <small class="text-muted" style="font-size: 10px;">Cashier</small>
            </div>
            <i class="fa-solid fa-chevron-down text-muted ms-1" style="font-size: 10px;"></i>
          </div>
        </div>
      </header>

      <!-- POS Workspace Grid -->
    <!-- In layout.pos -->
    <div class="pos-workspace @yield('workspace-class', 'pos-split')">
      @yield('content')
    </div>
    </div>
  </div>

  <!-- Bootstrap 5 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- POS Interaction Logic -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
        let cart = [
            { id: '1', title: 'Cappuccino', price: 2.50, qty: 1 },
            { id: '8', title: 'Croissant', price: 2.00, qty: 1 },
            { id: '7', title: 'Iced Coffee', price: 2.50, qty: 2 }
        ];

        const categoryChips = document.querySelectorAll('.category-chip');
        const productItems = document.querySelectorAll('.product-item');
        const searchInput = document.getElementById('searchInput');
        const cartItemsContainer = document.getElementById('cartItems');
        const subTotalEl = document.getElementById('subTotal');
        const taxValEl = document.getElementById('taxVal');
        const grandTotalEl = document.getElementById('grandTotal');
        const discountInput = document.getElementById('discountInput');
        const receivedInput = document.getElementById('receivedInput');
        const changeValEl = document.getElementById('changeVal');
        const payBtn = document.getElementById('payBtn');
        const cancelOrderBtn = document.getElementById('cancelOrderBtn');
        const clearCartBtn = document.getElementById('clearCartBtn');

        // Category Filter logic
        categoryChips.forEach(chip => {
            chip.addEventListener('click', () => {
                categoryChips.forEach(c => c.classList.remove('active'));
                chip.classList.add('active');
                const filter = chip.getAttribute('data-filter');
                
                productItems.forEach(item => {
                    if (filter === 'all' || item.getAttribute('data-category') === filter) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

        // Search logic
        searchInput.addEventListener('input', (e) => {
            const query = e.target.value.toLowerCase();
            productItems.forEach(item => {
                const title = item.getAttribute('data-title').toLowerCase();
                item.style.display = title.includes(query) ? 'block' : 'none';
            });
        });

        // Add Product to Cart
        productItems.forEach(item => {
            item.addEventListener('click', () => {
                const id = item.getAttribute('data-id');
                const title = item.getAttribute('data-title');
                const price = parseFloat(item.getAttribute('data-price'));

                const existing = cart.find(c => c.id === id);
                if (existing) {
                    existing.qty += 1;
                } else {
                    cart.push({ id, title, price, qty: 1 });
                }
                renderCart();
            });
        });

        // Render Cart & Totals
        window.renderCart = function() {
            cartItemsContainer.innerHTML = '';
            if (cart.length === 0) {
                cartItemsContainer.innerHTML = '<tr><td colspan="4" class="text-center text-muted py-3">No items added</td></tr>';
            } else {
                cart.forEach(item => {
                    const total = (item.price * item.qty).toFixed(2);
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td class="ps-2">
                            <div class="fw-semibold text-dark">${item.title}</div>
                        </td>
                        <td class="text-end text-muted">$${item.price.toFixed(2)}</td>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-1">
                                <button class="qty-btn" onclick="updateQty('${item.id}', -1)">-</button>
                                <span class="fw-bold px-1">${item.qty}</span>
                                <button class="qty-btn" onclick="updateQty('${item.id}', 1)">+</button>
                            </div>
                        </td>
                        <td class="text-end fw-semibold pe-2">$${total}</td>
                    `;
                    cartItemsContainer.appendChild(tr);
                });
            }
            calculateTotals();
        };

        window.updateQty = function(id, delta) {
            const item = cart.find(c => c.id === id);
            if (item) {
                item.qty += delta;
                if (item.qty <= 0) {
                    cart = cart.filter(c => c.id !== id);
                }
                renderCart();
            }
        };

        function calculateTotals() {
            const subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
            const discount = parseFloat(discountInput.value) || 0;
            const discountedTotal = Math.max(0, subtotal - discount);
            const tax = 0; // 0% tax based on design
            const grandTotal = discountedTotal + tax;

            const received = parseFloat(receivedInput.value) || 0;
            const change = Math.max(0, received - grandTotal);

            subTotalEl.textContent = `$${subtotal.toFixed(2)}`;
            taxValEl.textContent = `$${tax.toFixed(2)}`;
            grandTotalEl.textContent = `$${grandTotal.toFixed(2)}`;
            payBtn.textContent = `Pay $${grandTotal.toFixed(2)}`;
            changeValEl.textContent = `$${change.toFixed(2)}`;
        }

        discountInput.addEventListener('input', calculateTotals);
        receivedInput.addEventListener('input', calculateTotals);

        cancelOrderBtn.addEventListener('click', () => {
            cart = [];
            renderCart();
        });

        clearCartBtn.addEventListener('click', () => {
            cart = [];
            renderCart();
        });

        // Initial render
        renderCart();
    });
  </script>

</body>

</html>

```