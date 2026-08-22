@extends('layout.web')

@section('content')
<!-- 2. Hero Section -->
<section class="hero-tech">
    <div class="container">
        <div class="row align-items-center g-4">
            <div class="col-lg-6">
                <h1 class="mb-3">Top Artisanal Coffee & Brews</h1>
                <p class="mb-4">Explore our curated roast selections, cold brews, and premium coffee gear.</p>
                <a href="#featured" class="btn btn-green btn-lg">Shop Now</a>
            </div>
            <div class="col-lg-6 text-center">
                <img src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?auto=format&fit=crop&w=800&q=80"
                    alt="Coffee Set" class="img-fluid rounded-3 shadow-lg"
                    style="max-height: 380px; width: 100%; object-fit: cover;">
            </div>
        </div>
    </div>
</section>

<!-- 3. Value Proposition Bar -->
<div class="value-bar text-center">
    <div class="container">
        <div class="row g-3">
            <div class="col-md-4 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-truck text-success fs-5"></i>
                <span>Free Express Shipping Over $35</span>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-shield-check text-success fs-5"></i>
                <span>100% Organic & Freshly Roasted</span>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-headset text-success fs-5"></i>
                <span>24/7 Dedicated Support</span>
            </div>
        </div>
    </div>
</div>

<!-- 4. Featured Products Section -->
<section id="featured" class="pt-4">
    <div class="container">
        <h3 class="text-center section-title mb-4">Featured Products</h3>
        <div class="row g-4">

            <!-- Product 1 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="product-card">
                    <span class="product-badge badge-new">New</span>
                    <div class="product-img-box">
                        <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=400&q=80"
                            alt="Dark Roast Espresso" class="rounded">
                    </div>
                    <div class="product-title">Dark Roast Espresso</div>
                    <div class="product-price">$89.99</div>
                    <a class="btn btn-green w-100 mt-auto"  href="{{ route('webLogin') }}">Shop Now</a>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="product-card">
                    <div class="product-img-box">
                        <img src="https://images.unsplash.com/photo-1536256263959-770b48d82b0a?auto=format&fit=crop&w=400&q=80"
                            alt="Ceremonial Matcha" class="rounded">
                    </div>
                    <div class="product-title">Ceremonial Grade Matcha</div>
                    <div class="product-price">$199.00</div>
                    <a class="btn btn-green w-100 mt-auto" href="{{ route('webLogin') }}">Shop Now</a>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="product-card">
                    <div class="product-img-box">
                        <img src="https://images.unsplash.com/photo-1517256064527-09c73fc73e38?auto=format&fit=crop&w=400&q=80"
                            alt="Nitro Cold Brew" class="rounded">
                    </div>
                    <div class="product-title">Nitro Cold Brew Pack</div>
                    <div class="product-price">$129.00</div>
                    <a class="btn btn-green w-100 mt-auto" href="{{ route('webLogin') }}">Shop Now</a>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="product-card">
                    <span class="product-badge badge-sale">Sale</span>
                    <div class="product-img-box">
                        <img src="https://images.unsplash.com/photo-1551024709-8f23befc6f87?auto=format&fit=crop&w=400&q=80"
                            alt="Botanical Fizz" class="rounded">
                    </div>
                    <div class="product-title">Botanical Citrus Fizz</div>
                    <div class="product-price">$49.99 <span class="old-price">$59.99</span></div>
                    <a class="btn btn-green w-100 mt-auto" href="{{ route('webLogin') }}">Shop Now</a>
                </div>
            </div>

        </div>
    </div>
</section>
<section id="featured" class="py-5">
    <div class="container">
        <div class="row g-4">

            <!-- Product 1 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="product-card">
                    <span class="product-badge badge-new">New</span>
                    <div class="product-img-box">
                        <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=400&q=80"
                            alt="Dark Roast Espresso" class="rounded">
                    </div>
                    <div class="product-title">Dark Roast Espresso</div>
                    <div class="product-price">$89.99</div>
                    <a class="btn btn-green w-100 mt-auto" href="{{ route('webLogin') }}">Shop Now</a>
                </div>
            </div>

            <!-- Product 2 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="product-card">
                    <div class="product-img-box">
                        <img src="https://images.unsplash.com/photo-1536256263959-770b48d82b0a?auto=format&fit=crop&w=400&q=80"
                            alt="Ceremonial Matcha" class="rounded">
                    </div>
                    <div class="product-title">Ceremonial Grade Matcha</div>
                    <div class="product-price">$199.00</div>
                    <a class="btn btn-green w-100 mt-auto" href="{{ route('webLogin') }}">Shop Now</a>
                </div>
            </div>

            <!-- Product 3 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="product-card">
                    <div class="product-img-box">
                        <img src="https://images.unsplash.com/photo-1517256064527-09c73fc73e38?auto=format&fit=crop&w=400&q=80"
                            alt="Nitro Cold Brew" class="rounded">
                    </div>
                    <div class="product-title">Nitro Cold Brew Pack</div>
                    <div class="product-price">$129.00</div>
                    <a class="btn btn-green w-100 mt-auto" href="{{ route('webLogin') }}">Shop Now</a>
                </div>
            </div>

            <!-- Product 4 -->
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="product-card">
                    <span class="product-badge badge-sale">Sale</span>
                    <div class="product-img-box">
                        <img src="https://images.unsplash.com/photo-1551024709-8f23befc6f87?auto=format&fit=crop&w=400&q=80"
                            alt="Botanical Fizz" class="rounded">
                    </div>
                    <div class="product-title">Botanical Citrus Fizz</div>
                    <div class="product-price">$49.99 <span class="old-price">$59.99</span></div>
                    <a class="btn btn-green w-100 mt-auto" href="{{ route('webLogin') }}">Shop Now</a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 5. Middle Banner Promo -->
<section class="py-3">
    <div class="container">
        <div class="middle-promo-banner">
            <div class="row align-items-center g-4">
                <div class="col-lg-5">
                    <h2 class="fw-bold fs-1 mb-2">Elevate Your Morning Routine</h2>
                    <p class="text-light opacity-75 mb-4">Essential brewing equipment and single-origin beans for
                        coffee enthusiasts.</p>
                    <a href="#featured" class="btn btn-green">Browse Now</a>
                </div>
                <div class="col-lg-7">
                    <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=1000&q=80"
                        alt="Coffee Setup" class="img-fluid rounded-3"
                        style="max-height: 260px; width: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 6. Dual Category Section -->
<section class="py-5">
    <div class="container">
        <h3 class="text-center section-title mb-4">Best Sellers</h3>
        <div class="row g-4">
            <!-- New Arrivals Box -->
            <div class="col-md-6" id="new-arrivals">
                <div class="cat-banner-card">
                    <h4 class="fw-bold mb-3">New Arrivals</h4>
                    <div class="cat-banner-img">
                        <img src="https://images.unsplash.com/photo-1559056199-641a0ac8b55e?auto=format&fit=crop&w=500&q=80"
                            class="rounded" alt="New Roast">
                    </div>
                    <a href="#featured" class="btn btn-green w-50">Shop New</a>
                </div>
            </div>
            <!-- Best Sellers Box -->
            <div class="col-md-6" id="best-sellers">
                <div class="cat-banner-card">
                    <h4 class="fw-bold mb-3">Best Sellers</h4>
                    <div class="cat-banner-img">
                        <img src="https://images.unsplash.com/photo-1517256064527-09c73fc73e38?auto=format&fit=crop&w=500&q=80"
                            class="rounded" alt="Cold Brew">
                    </div>
                    <a href="#featured" class="btn btn-green w-50">Shop Bestsellers</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection