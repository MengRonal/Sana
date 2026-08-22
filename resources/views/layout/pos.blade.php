<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">

    <style>
        :root {
            --primary-color: #0d9468;
            --primary-light: #e6f4f0;
            --bg-color: #f2f7f5;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
        }

        /* Top Navigation Bar */
        .navbar-custom {
            background-color: var(--primary-color);
            color: white;
        }

        .navbar-custom .nav-link,
        .navbar-custom .navbar-brand {
            color: white;
        }

        /* Main Container */
        .pos-container {
            padding: 15px;
        }

        /* Left Section Cards */
        .products-wrapper {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
            height: 520px;
            overflow-y: auto;
        }

        .product-card {
            border: 1px solid #f0f0f0;
            border-radius: 6px;
            padding: 15px 10px;
            text-align: center;
            transition: all 0.2s;
            background: #fff;
            height: 100%;
            cursor: pointer;
            user-select: none;
        }

        .product-card:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
            border-color: var(--primary-color);
            transform: translateY(-2px);
        }

        .product-card img {
            height: 100px;
            object-fit: contain;
            margin-bottom: 10px;
            pointer-events: none;
        }

        .product-title {
            font-size: 13px;
            color: #333;
            margin-bottom: 4px;
            height: 32px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            pointer-events: none;
        }

        .product-price {
            color: var(--primary-color);
            font-weight: 700;
            font-size: 14px;
            pointer-events: none;
        }

        /* Category Navigation */
        .category-btn {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px;
            text-align: center;
            color: #888;
            font-weight: 500;
            cursor: pointer;
            width: 100%;
            transition: all 0.2s;
            user-select: none;
        }

        .category-btn.active {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background-color: #fff;
        }

        .category-btn i {
            font-size: 20px;
            display: block;
            margin-bottom: 5px;
        }

        /* Right Checkout Section */
        .checkout-card {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.03);
            min-height: 520px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .checkout-header {
            text-align: center;
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 15px;
        }

        .cart-table-wrapper {
            max-height: 250px;
            overflow-y: auto;
        }

        .cart-table th {
            background-color: #f8f9fa;
            color: #888;
            font-weight: 500;
            font-size: 12px;
            border: none;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        .qty-btn {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            background: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            padding: 0;
            cursor: pointer;
        }

        .qty-btn:hover {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-action-cancel {
            border: 1px solid #dc3545;
            color: #dc3545;
            background: white;
            font-weight: 500;
        }

        .btn-action-cancel:hover {
            background: #dc3545;
            color: white;
        }

        .btn-action-hold {
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
            background: white;
            font-weight: 500;
        }

        .btn-action-hold:hover {
            background: var(--primary-color);
            color: white;
        }

        .btn-action-pay {
            background: var(--primary-color);
            color: white;
            font-weight: 500;
        }

        .btn-action-pay:hover {
            background: #0b7a56;
            color: white;
        }

        .text-primary-custom {
            color: var(--primary-color) !important;
        }

        .search-input-group .form-control {
            border-radius: 20px 0 0 20px;
            background-color: #f0f3f2;
            border: none;
            font-size: 13px;
        }

        .search-input-group .btn {
            border-radius: 0 20px 20px 0;
            background-color: var(--primary-color);
            color: white;
        }

        .cursor-pointer {
            cursor: pointer;
        }
    </style>
</head>

<body>

    <!-- Header Navbar -->
    <nav class="navbar navbar-custom px-3 py-2">
        <div class="container-fluid p-0">
            <div class="d-flex align-items-center">
                <button class="btn text-white me-2"><i class="fa-solid fa-bars fs-5"></i></button>
                <span class="navbar-brand fw-bold mb-0 h1"><i class="fa-solid fa-store me-2"></i>POS SYSTEM</span>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="#" class="nav-link"><i class="fa-solid fa-utensils fs-5"></i></a>
                <a href="#" class="nav-link"><i class="fa-solid fa-store fs-5"></i></a>
                <a href="#" class="nav-link"><i class="fa-solid fa-receipt fs-5"></i></a>

                <div class="d-flex align-items-center ms-3">
                    <span class="me-2 fw-semibold">Adam</span>
                    <img src="https://i.pravatar.cc/40?img=68" class="rounded-circle" width="35" height="35" alt="User">
                </div>
            </div>
        </div>
    </nav>

    <!-- Main POS Layout -->
    <div class="container-fluid pos-container">
        @yield('content')
    </div>
    <!-- Place this right before </body> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript Logic -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
      // Cart State Storage
      let cart = [];

      const categoryBtns = document.querySelectorAll('.category-btn');
      const productItems = document.querySelectorAll('.product-item');
      const searchInput = document.getElementById('searchInput');
      const cartItemsContainer = document.getElementById('cartItems');
      
      const subTotalEl = document.getElementById('subTotal');
      const taxValEl = document.getElementById('taxVal');
      const grandTotalEl = document.getElementById('grandTotal');
      const discountInput = document.getElementById('discountInput');
      const payBtn = document.getElementById('payBtn');
      const cancelOrderBtn = document.getElementById('cancelOrderBtn');

      // Initial filter load
      filterProducts('coffee');

      // 1. Category Switcher logic
      categoryBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          categoryBtns.forEach(b => b.classList.remove('active'));
          btn.classList.add('active');
          filterProducts(btn.getAttribute('data-filter'));
        });
      });

      function filterProducts(category) {
        productItems.forEach(item => {
          if (category === 'all' || item.getAttribute('data-category') === category) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      }

      // 2. Search Logic
      searchInput.addEventListener('input', (e) => {
        const searchText = e.target.value.toLowerCase();
        productItems.forEach(item => {
          const title = item.getAttribute('data-title').toLowerCase();
          item.style.display = title.includes(searchText) ? 'block' : 'none';
        });
      });

      // 3. Add Product to Cart when Clicked
      productItems.forEach(item => {
        item.addEventListener('click', () => {
          const id = item.getAttribute('data-id');
          const title = item.getAttribute('data-title');
          const price = parseFloat(item.getAttribute('data-price'));

          const existingItem = cart.find(c => c.id === id);

          if (existingItem) {
            existingItem.qty += 1;
          } else {
            cart.push({ id, title, price, qty: 1 });
          }

          renderCart();
        });
      });

      // 4. Render Cart & Calculate Totals
      function renderCart() {
        cartItemsContainer.innerHTML = '';

        if (cart.length === 0) {
          cartItemsContainer.innerHTML = '<tr><td colspan="4" class="text-center text-muted py-4">No items added</td></tr>';
        } else {
          cart.forEach(item => {
            const itemTotal = (item.price * item.qty).toFixed(2);
            const tr = document.createElement('tr');

            tr.innerHTML = `
              <td><i class="fa-regular fa-trash-can text-danger cursor-pointer" onclick="removeItem('${item.id}')"></i></td>
              <td class="fw-semibold text-secondary">${item.title}</td>
              <td class="text-center">
                <div class="d-flex align-items-center justify-content-center gap-1">
                  <button class="qty-btn" onclick="updateQty('${item.id}', -1)">-</button>
                  <span class="px-1 fw-bold">${item.qty}</span>
                  <button class="qty-btn" onclick="updateQty('${item.id}', 1)">+</button>
                </div>
              </td>
              <td class="text-end fw-semibold text-secondary">$${itemTotal}</td>
            `;
            cartItemsContainer.appendChild(tr);
          });
        }

        calculateTotals();
      }

      // 5. Quantity Modifier
      window.updateQty = (id, delta) => {
        const item = cart.find(c => c.id === id);
        if (item) {
          item.qty += delta;
          if (item.qty <= 0) {
            removeItem(id);
          } else {
            renderCart();
          }
        }
      };

      // 6. Remove Item
      window.removeItem = (id) => {
        cart = cart.filter(c => c.id !== id);
        renderCart();
      };

      // 7. Calculate Order Math
      function calculateTotals() {
        const subTotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
        const discountPercent = parseFloat(discountInput.value) || 0;
        
        const discountAmount = subTotal * (discountPercent / 100);
        const discountedSubTotal = subTotal - discountAmount;
        
        const tax = discountedSubTotal * 0.015; // 1.5% tax
        const grandTotal = discountedSubTotal + tax;

        subTotalEl.textContent = `$${subTotal.toFixed(2)}`;
        taxValEl.textContent = `$${tax.toFixed(2)}`;
        grandTotalEl.textContent = `$${grandTotal.toFixed(2)}`;
        payBtn.textContent = `Pay ($${grandTotal.toFixed(2)})`;
      }

      // 8. Discount Input Change
      discountInput.addEventListener('input', calculateTotals);

      // 9. Clear / Cancel Order
      cancelOrderBtn.addEventListener('click', () => {
        cart = [];
        renderCart();
      });

      // Render default empty state
      renderCart();
    });
    </script>
</body>

</html>