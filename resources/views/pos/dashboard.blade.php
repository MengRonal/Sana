@extends('layout.pos')

@section('content')<div class="row g-3">

    <!-- Left Column: Products & Categories -->
    <div class="col-lg-8">

        <!-- Products Display Box -->
        <div class="products-wrapper mb-3">
            <!-- Search & Add Header -->
            <div class="row mb-3 align-items-center">
                <div class="col-md-6">

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Item
                    </button>
                    @include('pos.create')
                </div>
                <div class="col-md-6">
                    <div class="input-group search-input-group">
                        <input type="text" id="searchInput" class="form-control px-3"
                            placeholder="Search items here...">
                        <button class="btn" type="button"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-3" id="productGrid">

                <!-- COFFEE ITEMS -->
                <div class="col product-item" data-category="coffee" data-id="1" data-title="Costa Coffee"
                    data-price="7.99">
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1572442388796-11668a67e53d?w=200&auto=format&fit=crop"
                            alt="Coffee">
                        <div class="product-title">Costa Coffee</div>
                        <div class="product-price">$7.99</div>
                    </div>
                </div>

                <div class="col product-item" data-category="coffee" data-id="2" data-title="Mocha/Hot Chocolate"
                    data-price="9.99">
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1541167760496-1628856ab772?w=200&auto=format&fit=crop"
                            alt="Coffee">
                        <div class="product-title">Mocha/Hot Chocolate</div>
                        <div class="product-price">$9.99</div>
                    </div>
                </div>

                <div class="col product-item" data-category="coffee" data-id="3" data-title="Costa Caramel Latte"
                    data-price="5.54">
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1517701604599-bb29b565090c?w=200&auto=format&fit=crop"
                            alt="Coffee">
                        <div class="product-title">Costa Caramel Latte</div>
                        <div class="product-price">$5.54</div>
                    </div>
                </div>

                <!-- BEVERAGES ITEMS -->
                <div class="col product-item" data-category="beverages" data-id="4" data-title="Iced Lemon Tea"
                    data-price="3.50">
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1513558161293-cdaf765ed2fd?w=200&auto=format&fit=crop"
                            alt="Iced Tea">
                        <div class="product-title">Iced Lemon Tea</div>
                        <div class="product-price">$3.50</div>
                    </div>
                </div>

                <div class="col product-item" data-category="beverages" data-id="5" data-title="Mango Smoothie"
                    data-price="4.99">
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=200&auto=format&fit=crop"
                            alt="Smoothie">
                        <div class="product-title">Mango Smoothie</div>
                        <div class="product-price">$4.99</div>
                    </div>
                </div>

                <!-- BBQ ITEMS -->
                <div class="col product-item" data-category="bbq" data-id="6" data-title="BBQ Pork Ribs"
                    data-price="18.99">
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=200&auto=format&fit=crop"
                            alt="BBQ Ribs">
                        <div class="product-title">BBQ Pork Ribs</div>
                        <div class="product-price">$18.99</div>
                    </div>
                </div>

                <div class="col product-item" data-category="bbq" data-id="7" data-title="Ribeye Steak"
                    data-price="24.50">
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1529193591184-b1d58069ecdd?w=200&auto=format&fit=crop"
                            alt="Steak">
                        <div class="product-title">Ribeye Steak</div>
                        <div class="product-price">$24.50</div>
                    </div>
                </div>

                <!-- SNACKS ITEMS -->
                <div class="col product-item" data-category="snacks" data-id="8" data-title="Crispy French Fries"
                    data-price="4.50">
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=200&auto=format&fit=crop"
                            alt="Fries">
                        <div class="product-title">Crispy French Fries</div>
                        <div class="product-price">$4.50</div>
                    </div>
                </div>

                <!-- DESSERTS ITEMS -->
                <div class="col product-item" data-category="deserts" data-id="9" data-title="Chocolate Cake"
                    data-price="6.50">
                    <div class="product-card">
                        <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=200&auto=format&fit=crop"
                            alt="Cake">
                        <div class="product-title">Chocolate Cake</div>
                        <div class="product-price">$6.50</div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Categories Selector -->
        <div class="row g-2">
            <div class="col">
                <div class="category-btn active" data-filter="coffee">
                    <i class="fa-solid fa-mug-hot"></i> Coffee
                </div>
            </div>
            <div class="col">
                <div class="category-btn" data-filter="beverages">
                    <i class="fa-solid fa-glass-water"></i> Beverages
                </div>
            </div>
            <div class="col">
                <div class="category-btn" data-filter="bbq">
                    <i class="fa-solid fa-fire"></i> BBQ
                </div>
            </div>
            <div class="col">
                <div class="category-btn" data-filter="snacks">
                    <i class="fa-solid fa-cookie-bite"></i> Snacks
                </div>
            </div>
            <div class="col">
                <div class="category-btn" data-filter="deserts">
                    <i class="fa-solid fa-cake-candles"></i> Deserts
                </div>
            </div>
        </div>

    </div>

    <!-- Right Column: Cart / Checkout Panel -->
    <div class="col-lg-4 d-flex flex-column justify-content-between">

        <div class="checkout-card mb-3">
            <div>
                <div class="checkout-header">Checkout</div>

                <!-- Selected Items Table -->
                <div class="cart-table-wrapper">
                    <table class="table align-middle cart-table">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10%"></th>
                                <th scope="col" style="width: 40%">Name</th>
                                <th scope="col" class="text-center" style="width: 25%">QTY</th>
                                <th scope="col" class="text-end" style="width: 25%">Price</th>
                            </tr>
                        </thead>
                        <tbody id="cartItems">
                            <!-- Cart items rendered dynamically by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Summary Breakdown -->
            <div class="pt-3 border-top mt-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted">Discount (%)</span>
                    <input type="number" id="discountInput" class="form-control text-center py-0" value="20" min="0"
                        max="100" style="width: 60px; height: 28px; font-size: 12px;">
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Sub Total</span>
                    <span class="fw-semibold text-secondary" id="subTotal">$0.00</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Tax <span class="text-primary-custom">1.5%</span></span>
                    <span class="fw-semibold text-secondary" id="taxVal">$0.00</span>
                </div>

                <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                    <span class="fw-bold fs-5">Total</span>
                    <span class="fw-bold fs-5 text-primary-custom" id="grandTotal">$0.00</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row g-2">
            <div class="col-6">
                <button class="btn btn-action-cancel w-100 py-2" id="cancelOrderBtn">Cancel Order</button>
            </div>
            <div class="col-6">
                <button class="btn btn-action-hold w-100 py-2">Hold Order</button>
            </div>
            <div class="col-12 mt-2">
                <button type="button" class="btn btn-action-pay w-100 py-2" data-bs-toggle="modal" data-bs-target="#payment">
                    Pay
                </button>
                @include('pos.payment')
            </div>
        </div>

    </div>

</div>
@endsection
