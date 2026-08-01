
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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