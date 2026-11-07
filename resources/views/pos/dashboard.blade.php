@extends('layout.pos')

@section('content')
<!-- LEFT PANEL: Current Order / Checkout -->
<div class="card-panel d-flex flex-column justify-content-between">
    <div>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h6 class="fw-bold m-0">Current Order</h6>
            <span class="order-badge">Dine In</span>
        </div>

        <!-- Customer Search Input -->
        <div class="input-group input-group-sm mb-3">
            <input type="text" class="form-control" placeholder="Search customer..." id="customerInput">
            <button class="btn btn-outline-secondary" type="button"><i class="fa-solid fa-user-plus"></i></button>
        </div>

        <!-- Cart Items Table -->
        <div class="cart-table-container border rounded mb-3">
            <table class="table table-sm align-middle mb-0 cart-table">
                <thead>
                    <tr>
                        <th class="ps-2">Item</th>
                        <th class="text-end">Price</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end pe-2">Total</th>
                    </tr>
                </thead>
                <tbody id="cartItems">
                    <!-- Dynamically populated via JS -->
                </tbody>
            </table>
        </div>

        <!-- Add Note -->
        <div class="border rounded p-2 text-center text-muted mb-3 bg-light cursor-pointer" style="font-size: 12px;">
            <i class="fa-solid fa-plus me-1"></i> Add Note
        </div>

        <!-- Financial Summary -->
        <div class="d-flex justify-content-between mb-2 text-muted">
            <span>Subtotal</span>
            <span class="fw-semibold text-dark" id="subTotal">$9.50</span>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-2 text-muted">
            <span>Discount</span>
            <div style="width: 80px;">
                <input type="number" class="form-control form-control-sm text-end" id="discountInput" value="0.00">
            </div>
        </div>
        <div class="d-flex justify-content-between mb-3 text-muted">
            <span>Tax (0%)</span>
            <span class="fw-semibold text-dark" id="taxVal">$0.00</span>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3 border-top pt-2">
            <span class="fw-bold fs-6 text-dark">Total</span>
            <span class="fw-bold fs-4 text-success" id="grandTotal">$9.50</span>
        </div>

        <!-- Payment Methods -->
        <label class="form-label text-muted fw-semibold" style="font-size: 11px;">Payment Method</label>
        <div class="row g-2 mb-3">
            <div class="col-3">
                <div class="payment-method-btn active"><i
                        class="fa-solid fa-money-bill-wave d-block mb-1 text-success"></i>Cash</div>
            </div>
            <div class="col-3">
                <div class="payment-method-btn"><i class="fa-solid fa-qrcode d-block mb-1 text-danger"></i>KHQR</div>
            </div>
            <div class="col-3">
                <div class="payment-method-btn"><i
                        class="fa-solid fa-building-columns d-block mb-1 text-primary"></i>ABA</div>
            </div>
            <div class="col-3">
                <div class="payment-method-btn"><i class="fa-regular fa-credit-card d-block mb-1 text-info"></i>Card
                </div>
            </div>
        </div>

        <!-- Received & Change -->
        <div class="row g-2 mb-3 align-items-center">
            <div class="col-8">
                <label class="form-label text-muted m-0" style="font-size: 11px;">Received</label>
                <input type="number" class="form-control form-control-sm" id="receivedInput" value="10.00">
            </div>
            <div class="col-4 text-end">
                <label class="form-label text-muted m-0" style="font-size: 11px;">Change</label>
                <div class="fw-bold text-success fs-5" id="changeVal">$0.50</div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row g-2 pt-2 border-top">
        <div class="col-4">
            <button class="btn btn-outline-danger btn-sm w-100 fw-semibold" id="cancelOrderBtn"
                style="font-size: 11px;">
                <i class="fa-regular fa-trash-can me-1"></i> Cancel
            </button>
        </div>
        <div class="col-4">
            <button class="btn btn-outline-warning text-dark btn-sm w-100 fw-semibold"
                style="font-size: 11px; border-color:#e0a800;">
                <i class="fa-regular fa-clock me-1"></i> Hold
            </button>
        </div>
        <div class="col-4">
            <button class="btn btn-success btn-sm w-100 fw-semibold" id="payBtn"
                style="background-color: var(--primary-color); font-size: 11px;">
                Pay $9.50
            </button>
        </div>
    </div>
</div>

<!-- RIGHT PANEL: Product Catalog & Categories -->
<div class="card-panel d-flex flex-column justify-content-between">
    <div>
        <h6 class="fw-bold mb-3">Select Product</h6>

        <!-- Categories Selector -->
        <div class="categories-scroll mb-4">
            <div class="category-chip active" data-filter="all"><i class="fa-solid fa-border-all"></i> All</div>
            <div class="category-chip" data-filter="coffee"><i class="fa-solid fa-mug-saucer"></i> Coffee</div>
            <div class="category-chip" data-filter="tea"><i class="fa-solid fa-leaf"></i> Tea</div>
            <div class="category-chip" data-filter="cold-drinks"><i class="fa-solid fa-glass-water"></i> Cold Drinks
            </div>
            <div class="category-chip" data-filter="bakery"><i class="fa-solid fa-bread-slice"></i> Bakery</div>
            <div class="category-chip" data-filter="dessert"><i class="fa-solid fa-cake-candles"></i> Dessert</div>
        </div>

        <!-- Products Grid -->
        <div class="product-grid" id="productGrid">
            <!-- Product Item 1 -->
            <div class="product-card product-item" data-id="1" data-title="Cappuccino" data-price="2.50"
                data-category="coffee">
                <img src="https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=200&auto=format&fit=crop&q=80"
                    alt="Cappuccino">
                <div class="fw-semibold text-truncate" style="font-size:12px;">Cappuccino</div>
                <div class="text-success fw-bold" style="font-size:12px;">$2.50</div>
                <div class="add-badge"><i class="fa-solid fa-plus"></i></div>
            </div>

            <!-- Product Item 2 -->
            <div class="product-card product-item" data-id="2" data-title="Americano" data-price="2.00"
                data-category="coffee">
                <img src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?w=200&auto=format&fit=crop&q=80"
                    alt="Americano">
                <div class="fw-semibold text-truncate" style="font-size:12px;">Americano</div>
                <div class="text-success fw-bold" style="font-size:12px;">$2.00</div>
                <div class="add-badge"><i class="fa-solid fa-plus"></i></div>
            </div>

            <!-- Product Item 3 -->
            <div class="product-card product-item" data-id="3" data-title="Latte" data-price="2.75"
                data-category="coffee">
                <img src="https://images.unsplash.com/photo-1561882468-9110e5c16b38?w=200&auto=format&fit=crop&q=80"
                    alt="Latte">
                <div class="fw-semibold text-truncate" style="font-size:12px;">Latte</div>
                <div class="text-success fw-bold" style="font-size:12px;">$2.75</div>
                <div class="add-badge"><i class="fa-solid fa-plus"></i></div>
            </div>

            <!-- Product Item 4 -->
            <div class="product-card product-item" data-id="4" data-title="Mocha" data-price="2.75"
                data-category="coffee">
                <img src="https://images.unsplash.com/photo-1578314675249-a6919f3cbce3?w=200&auto=format&fit=crop&q=80"
                    alt="Mocha">
                <div class="fw-semibold text-truncate" style="font-size:12px;">Mocha</div>
                <div class="text-success fw-bold" style="font-size:12px;">$2.75</div>
                <div class="add-badge"><i class="fa-solid fa-plus"></i></div>
            </div>

            <!-- Product Item 5 -->
            <div class="product-card product-item" data-id="5" data-title="Espresso" data-price="1.50"
                data-category="coffee">
                <img src="https://images.unsplash.com/photo-1510591509098-f4fdc6d0ff04?w=200&auto=format&fit=crop&q=80"
                    alt="Espresso">
                <div class="fw-semibold text-truncate" style="font-size:12px;">Espresso</div>
                <div class="text-success fw-bold" style="font-size:12px;">$1.50</div>
                <div class="add-badge"><i class="fa-solid fa-plus"></i></div>
            </div>

            <!-- Product Item 6 -->
            <div class="product-card product-item" data-id="6" data-title="Green Tea" data-price="2.00"
                data-category="tea">
                <img src="https://images.unsplash.com/photo-1627435601361-ec25f5b1d0e5?w=200&auto=format&fit=crop&q=80"
                    alt="Green Tea">
                <div class="fw-semibold text-truncate" style="font-size:12px;">Green Tea</div>
                <div class="text-success fw-bold" style="font-size:12px;">$2.00</div>
                <div class="add-badge"><i class="fa-solid fa-plus"></i></div>
            </div>

            <!-- Product Item 7 -->
            <div class="product-card product-item" data-id="7" data-title="Iced Coffee" data-price="2.50"
                data-category="cold-drinks">
                <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?w=200&auto=format&fit=crop&q=80"
                    alt="Iced Coffee">
                <div class="fw-semibold text-truncate" style="font-size:12px;">Iced Coffee</div>
                <div class="text-success fw-bold" style="font-size:12px;">$2.50</div>
                <div class="add-badge"><i class="fa-solid fa-plus"></i></div>
            </div>

            <!-- Product Item 8 -->
            <div class="product-card product-item" data-id="8" data-title="Croissant" data-price="2.00"
                data-category="bakery">
                <img src="https://images.unsplash.com/photo-1555507036-ab1f4038808a?w=200&auto=format&fit=crop&q=80"
                    alt="Croissant">
                <div class="fw-semibold text-truncate" style="font-size:12px;">Croissant</div>
                <div class="text-success fw-bold" style="font-size:12px;">$2.00</div>
                <div class="add-badge"><i class="fa-solid fa-plus"></i></div>
            </div>

            <!-- Product Item 9 -->
            <div class="product-card product-item" data-id="9" data-title="Cheesecake" data-price="3.25"
                data-category="dessert">
                <img src="https://images.unsplash.com/photo-1533134242443-d4fd215305ad?w=200&auto=format&fit=crop&q=80"
                    alt="Cheesecake">
                <div class="fw-semibold text-truncate" style="font-size:12px;">Cheesecake</div>
                <div class="text-success fw-bold" style="font-size:12px;">$3.25</div>
                <div class="add-badge"><i class="fa-solid fa-plus"></i></div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Footer -->
    <div class="d-flex gap-2 pt-3 border-top mt-3">
        <button class="btn btn-outline-secondary btn-sm flex-fill bg-white" style="font-size: 11px;"><i
                class="fa-solid fa-clock-rotate-left me-1"></i> Recent Orders</button>
        <button class="btn btn-outline-secondary btn-sm flex-fill bg-white" style="font-size: 11px;"><i
                class="fa-solid fa-receipt me-1"></i> Orders</button>
        <button class="btn btn-outline-secondary btn-sm flex-fill bg-white" style="font-size: 11px;"><i
                class="fa-solid fa-chair me-1"></i> Table</button>
        <button class="btn btn-outline-danger btn-sm flex-fill bg-white" style="font-size: 11px;" id="clearCartBtn"><i
                class="fa-regular fa-trash-can me-1"></i> Clear Cart</button>
    </div>
    @endsection