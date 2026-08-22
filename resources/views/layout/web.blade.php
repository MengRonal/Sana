<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NÉCTAR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-green: #2e7d32;
            --primary-green-hover: #1b5e20;
            --dark-bg: #121518;
            --dark-card: #1c2126;
            --light-card-bg: #f3f4f6;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --bg-white: #ffffff;
            --badge-red: #d32f2f;
            --badge-green: #2e7d32;
        }

        body {
            background-color: #f8fafc;
            color: var(--text-dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Navbar Header */
        .navbar-tech {
            background-color: var(--dark-bg);
            padding: 16px 0;
        }

        .navbar-tech .navbar-brand {
            color: #ffffff;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .navbar-tech .nav-link {
            color: #cbd5e1;
            font-weight: 500;
            font-size: 0.95rem;
            margin: 0 10px;
            transition: color 0.2s;
        }

        .navbar-tech .nav-link:hover {
            color: #ffffff;
        }

        /* Buttons */
        .btn-green {
            background-color: var(--primary-green);
            color: #ffffff;
            font-weight: 700;
            border: none;
            border-radius: 4px;
            padding: 10px 24px;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-green:hover {
            background-color: var(--primary-green-hover);
            color: #ffffff;
        }

        /* Hero Section */
        .hero-tech {
            background-color: var(--dark-bg);
            color: #ffffff;
            padding: 60px 0 80px 0;
            position: relative;
        }

        .hero-tech h1 {
            font-weight: 800;
            font-size: 3rem;
            line-height: 1.15;
        }

        .hero-tech p {
            color: #94a3b8;
            font-size: 1.15rem;
        }

        /* Feature Benefit Bar */
        .value-bar {
            background-color: var(--dark-card);
            border-top: 1px solid #2d3748;
            color: #ffffff;
            padding: 16px 0;
            font-size: 0.9rem;
            font-weight: 600;
        }

        /* Section Headers */
        .section-title {
            font-weight: 800;
            color: #1e293b;
            position: relative;
            display: inline-block;
        }

        /* Product Cards */
        .product-card {
            background-color: var(--light-card-bg);
            border-radius: 8px;
            padding: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
            border: 1px solid #e2e8f0;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.06);
        }

        .product-img-box {
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .product-img-box img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
        }

        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 4px;
            color: #ffffff;
        }

        .badge-sale {
            background-color: var(--badge-red);
        }

        .badge-new {
            background-color: var(--badge-green);
        }

        .product-title {
            font-weight: 700;
            font-size: 1rem;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .product-price {
            font-weight: 800;
            font-size: 1.1rem;
            color: #0f172a;
            margin-bottom: 15px;
        }

        .product-price .old-price {
            text-decoration: line-through;
            color: #94a3b8;
            font-size: 0.85rem;
            font-weight: 500;
            margin-left: 6px;
        }

        /* Middle Banner Promo */
        .middle-promo-banner {
            background-color: var(--dark-bg);
            border-radius: 8px;
            overflow: hidden;
            color: #ffffff;
            padding: 40px;
        }

        /* Dual Category Banners */
        .cat-banner-card {
            background-color: var(--light-card-bg);
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .cat-banner-img {
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .cat-banner-img img {
            max-height: 100%;
            object-fit: contain;
        }

        /* Newsletter Section */
        .newsletter-section {
            background-color: var(--dark-bg);
            color: #ffffff;
            padding: 50px 0;
        }

        /* Footer */
        footer {
            background-color: #0b0d0e;
            color: #94a3b8;
            padding: 40px 0 20px 0;
            font-size: 0.875rem;
        }

        footer a {
            color: #cbd5e1;
            text-decoration: none;
        }

        footer a:hover {
            color: #ffffff;
        }
    </style>
    <style>
        .hide-arrow::after {
        display: none !important;
        }
        :root {
            --primary-green: #10b981;
            --primary-green-hover: #059669;
            --light-green-bg: #f0fdf4;
            --border-green: #a7f3d0;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --bg-white: #ffffff;
            --bg-slate: #f8fafc;
        }

        body {
            background-color: var(--bg-slate);
            color: var(--text-dark);
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Navbar */
        .navbar-clean {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
        }

        .navbar-clean .nav-link {
            color: var(--text-dark);
            font-weight: 500;
            margin: 0 8px;
        }

        .navbar-clean .nav-link:hover {
            color: var(--primary-green);
        }

        /* Buttons */
        .btn-green {
            background-color: var(--primary-green);
            color: var(--bg-white);
            font-weight: 600;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-green:hover {
            background-color: var(--primary-green-hover);
            color: var(--bg-white);
        }

        .btn-outline-green {
            border: 1px solid var(--primary-green);
            color: var(--primary-green);
            font-weight: 600;
            background-color: transparent;
        }

        .btn-outline-green:hover {
            background-color: var(--primary-green);
            color: var(--bg-white);
        }

        /* Hero */
        .hero-clean {
            background: linear-gradient(180deg, var(--light-green-bg) 0%, var(--bg-slate) 100%);
            padding: 70px 0 50px 0;
        }

        /* Category Navigation Pills */
        .category-pills .nav-link {
            color: var(--text-muted);
            background-color: var(--bg-white);
            border: 1px solid #e2e8f0;
            border-radius: 30px;
            padding: 10px 24px;
            font-weight: 600;
            font-size: 0.95rem;
            margin: 4px;
            transition: all 0.2s ease;
        }

        .category-pills .nav-link:hover {
            border-color: var(--primary-green);
            color: var(--primary-green);
        }

        .category-pills .nav-link.active {
            background-color: var(--primary-green);
            color: var(--bg-white);
            border-color: var(--primary-green);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        }

        /* Product Cards */
        .product-card {
            background-color: var(--bg-white);
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.05);
            border-color: var(--border-green);
        }

        .product-img-box {
            height: 200px;
            position: relative;
            background-color: #f1f5f9;
            overflow: hidden;
        }

        .product-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .badge-green {
            position: absolute;
            top: 12px;
            left: 12px;
            background-color: var(--primary-green);
            color: var(--bg-white);
            font-size: 0.7rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Offcanvas */
        .offcanvas-clean {
            background-color: var(--bg-white);
        }

        .cart-thumb {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #ffffff;
        }
    
        /* Info Bar Outer Window */
        .info-bar {
            background-color: #0b1519;
            /* Dark background matching the image */
            color: #ffffff;
            padding: 14px 0;
            width: 100%;
            overflow: hidden;
            /* Hide anything cutting outside the wrapper bounds */
            position: relative;
        }
    
        /* Continuous Left-to-Right Scrolling Marquee Wrapper */
        .info-bar-marquee {
            display: flex;
            width: max-content;
            /* Ensure container matches absolute child sizes */
            animation: scrollRight 25s linear infinite;
            /* Loops forever */
        }
    
        /* Pause rotation animation on mouse hover for easy reading/clicking */
        .info-bar:hover .info-bar-marquee {
            animation-play-state: paused;
        }
    
        /* Main duplicate groups flanking one another for infinite seamless looping */
        .marquee-group {
            display: flex;
            align-items: center;
            justify-content: space-around;
            min-width: 100vw;
            /* Takes full window width to compute fluid transitions */
            gap: 60px;
            padding-right: 60px;
            /* Maintains uniform spacers when tracking sets */
        }
    
        /* Individual Feature Item */
        .info-bar-item {
            display: flex;
            align-items: center;
            gap: 10px;
            /* Space between icon and text */
            font-size: 14px;
            font-weight: 500;
            letter-spacing: 0.2px;
            cursor: pointer;
            transition: opacity 0.2s ease;
            white-space: nowrap;
            /* Prevent copy lines breaking in mid-sentence */
        }
    
        .info-bar-item:hover {
            opacity: 0.85;
        }
    
        /* SVG Icon Customization */
        .info-bar-icon {
            width: 20px;
            height: 20px;
            stroke: #10b981;
            /* Green accent color for icons */
            stroke-width: 2;
            fill: none;
            stroke-linecap: round;
            stroke-linejoin: round;
            flex-shrink: 0;
        }
    
        /* Toast Message Notification Styles */
        .toast-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }
    
        .toast {
            background-color: white;
            color: black;
            padding: 12px 24px;
            border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            font-size: 14px;
            margin-top: 10px;
            border-left: 4px solid #10b981;
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
    
        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }
    
        /* Infinite Left-to-Right Scrolling Animation Core */
        @keyframes scrollRight {
            0% {
                transform: translateX(-50%);
                /* Starts offset back left by one complete duplicated set length */
            }
    
            100% {
                transform: translateX(0%);
                /* Smoothly travels forward across exactly one set width */
            }
        }
    
        /* Tablet and Mobile Optimization adjustments */
        @media (max-width: 768px) {
            .info-bar-item {
                font-size: 13px;
            }
    
            .marquee-group {
                gap: 40px;
                padding-right: 40px;
            }
    
            @keyframes scrollRight {
                0% {
                    transform: translateX(-50%);
                }
    
                100% {
                    transform: translateX(0%);
                }
            }
        }
    </style>
</head>

<body>
    <div class="info-bar">
        <!-- The scrolling marquee inner carriage tracks sets infinitely -->
        <div class="info-bar-marquee">
    
            <!-- MARQUEE SET 1 (Original track node) -->
            <div class="marquee-group">
                <!-- Item 1: Shipping -->
                <div class="info-bar-item"
                    onclick="showInfo('Free shipping applies automatically at checkout for orders over \$35.')">
                    <svg class="info-bar-icon" viewBox="0 0 24 24">
                        <rect x="1" y="3" width="15" height="13"></rect>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                    <span>Free Express Shipping Over \$35</span>
                </div>
    
                <!-- Item 2: Organic Quality -->
                <div class="info-bar-item"
                    onclick="showInfo('Our beans are sustainably certified organic, locally sourced, and freshly roasted daily.')">
                    <svg class="info-bar-icon" viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <path d="M9 11l2 2 4-4"></path>
                    </svg>
                    <span>100% Organic & Freshly Roasted</span>
                </div>
    
                <!-- Item 3: Support -->
                <div class="info-bar-item"
                    onclick="showInfo('Need assistance? Our support team is available via chat, email, or telephone anytime.')">
                    <svg class="info-bar-icon" viewBox="0 0 24 24">
                        <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                        <path
                            d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z">
                        </path>
                    </svg>
                    <span>24/7 Dedicated Support</span>
                </div>
            </div>
    
            <!-- MARQUEE SET 2 (Cloned twin duplicate to prevent white whitespace gaps during transitions) -->
            <div class="marquee-group" aria-hidden="true">
                <!-- Item 1 Duplicate -->
                <div class="info-bar-item"
                    onclick="showInfo('Free shipping applies automatically at checkout for orders over \$35.')">
                    <svg class="info-bar-icon" viewBox="0 0 24 24">
                        <rect x="1" y="3" width="15" height="13"></rect>
                        <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                        <circle cx="5.5" cy="18.5" r="2.5"></circle>
                        <circle cx="18.5" cy="18.5" r="2.5"></circle>
                    </svg>
                    <span>Free Express Shipping Over \$35</span>
                </div>
    
                <!-- Item 2 Duplicate -->
                <div class="info-bar-item"
                    onclick="showInfo('Our beans are sustainably certified organic, locally sourced, and freshly roasted daily.')">
                    <svg class="info-bar-icon" viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        <path d="M9 11l2 2 4-4"></path>
                    </svg>
                    <span>100% Organic & Freshly Roasted</span>
                </div>
    
                <!-- Item 3 Duplicate -->
                <div class="info-bar-item"
                    onclick="showInfo('Need assistance? Our support team is available via chat, email, or telephone anytime.')">
                    <svg class="info-bar-icon" viewBox="0 0 24 24">
                        <path d="M3 18v-6a9 9 0 0 1 18 0v6"></path>
                        <path
                            d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z">
                        </path>
                    </svg>
                    <span>24/7 Dedicated Support</span>
                </div>
            </div>
    
        </div>
    </div>
    
    <!-- Container for dynamic text popups (Toasts) -->
    <div class="toast-container" id="toastContainer"></div>

    <!-- 1. Header Navbar -->
    <nav class="navbar navbar-expand-lg navbar-clean sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4 d-flex align-items-center text-dark" href="#">
                <span
                    class="p-2 rounded-circle bg-light-green text-green me-2 d-inline-flex align-items-center justify-content-center"
                    style="width: 36px; height: 36px; background-color: var(--light-green-bg); color: var(--primary-green);">
                    <i class="bi bi-cup-hot-fill fs-5"></i>
                </span>
                NÉCTAR
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#cleanNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="cleanNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" href="/web/shop">Shop</a></li>
                    <li class="nav-item"><a class="nav-link" href="#new-arrivals">New Arrivals</a></li>
                    <li class="nav-item"><a class="nav-link" href="#best-sellers">Best Sellers</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"
                            onclick="event.preventDefault(); if(confirm('Do you want to logout?')) { document.getElementById('logout-form').submit(); }">
                            Sign Out <i class="dropdown-item-icon ti-power-off"></i>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                
                    <!-- ១. PROFILE POPUP DROPDOWN -->
                    <div class="dropdown">
                        <button class="btn border-0 p-0 text-dark dropdown-toggle hide-arrow" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-person" style="font-size: 25px;"></i>
                        </button>
                
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2 p-3" style="width: 250px;">
                            @auth
                            {{-- ករណី User បាន Login រួច --}}
                            <li class="mb-2">
                                <div class="fw-bold text-dark text-truncate">
                                    Name: {{ Auth::user()->customer?->name ?? Auth::user()->name }}
                                </div>
                                <small class="text-muted d-block text-truncate">
                                    Phone: {{ Auth::user()->phone ?? Auth::user()->email }}
                                </small>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item rounded-2 py-2" href="#">
                                    <i class="bi bi-bag-check me-2"></i> My Orders
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-2 py-2" href="#">
                                    <i class="bi bi-gear me-2"></i> Settings
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                {{-- Form សម្រាប់ Logout តាមវិធីត្រឹមត្រូវ --}}
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="dropdown-item rounded-2 py-2 text-danger w-100 text-start border-0 bg-transparent">
                                        <i class="bi bi-box-arrow-right me-2"></i> Log Out
                                    </button>
                                </form>
                            </li>
                            @else
                            {{-- ករណីមិនទាន់បាន Login --}}
                            <li class="text-center py-2">
                                <p class="small text-muted mb-3">Welcome! Please login to manage your account.</p>
                                <a href="{{ url('web/login') }}" class="btn btn-success w-100 rounded-2 mb-2">Log In</a>
                                <a href="{{ url('web/register') }}" class="btn btn-outline-secondary w-100 rounded-2">Register</a>
                            </li>
                            @endauth
                        </ul>
                    </div>
                
                    <!-- ២. CART BUTTON (បន្តបើក cartOffcanvas ដូចដើម) -->
                    <button class="btn border-0 p-0 position-relative text-dark" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#cartOffcanvas">
                        <i class="bi bi-bag" style="font-size: 22px;"></i>
                        <span id="cart-badge"
                            class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-success text-white d-none"
                            style="font-size: 0.65rem;">0</span>
                    </button>
                
                </div>
            </div>
        </div>
    </nav>
    {{-- container --}}
    @yield('content')
    {{-- endcontainer --}}
    <!-- 8. Footer -->
    <footer>
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-6 col-md-3">
                    <h6 class="text-white fw-bold mb-3">Quick Links</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="/web/shop">Shop</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Subscriptions</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md-3">
                    <h6 class="text-white fw-bold mb-3">Customer Service</h6>
                    <ul class="list-unstyled d-flex flex-column gap-2">
                        <li><a href="#">Shipping Info</a></li>
                        <li><a href="#">Return Policy</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-md-6 text-md-end">
                    <h6 class="text-white fw-bold mb-3">Follow Us</h6>
                    <div class="d-flex justify-content-md-end gap-3 fs-5">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- demo data --}}

    <script>
        // Synchronized Product Menu Data Source Layer mapping items arrays mapping directly
            const menuItems = [
                { id: '1', category: 'coffee', name: 'Dark Roast Espresso', desc: 'Rich espresso with dark chocolate undertones.', price: 4.50, badge: 'Popular', img: 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=400&q=80' },
                { id: '2', category: 'coffee', name: 'Iced Oat Matcha Latte', desc: 'Ceremonial grade matcha with oat milk.', price: 5.50, badge: '', img: 'https://images.unsplash.com/photo-1536256263959-770b48d82b0a?auto=format&fit=crop&w=400&q=80' },
                { id: '3', category: 'drinks', name: 'Nitrogen Cold Brew', desc: 'Steeped for 24 hours with creamy cascade.', price: 5.25, badge: 'Best Seller', img: 'https://images.unsplash.com/photo-1517256064527-09c73fc73e38?auto=format&fit=crop&w=400&q=80' },
                { id: '4', category: 'drinks', name: 'Botanical Citrus Fizz', desc: 'Sparkling herbal refreshment over ice.', price: 6.00, badge: 'New', img: 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?auto=format&fit=crop&w=400&q=80' },
                { id: '5', category: 'water', name: 'Artisanal Glacier Water', desc: 'Pure mineral spring water served chilled.', price: 3.00, badge: '', img: 'https://images.unsplash.com/photo-1548839140-29a749e1bc4e?auto=format&fit=crop&w=400&q=80' },
                { id: '6', category: 'water', name: 'Sparkling Lime Water', desc: 'Zero calories naturally flavored sparkling water.', price: 3.50, badge: '', img: 'https://images.unsplash.com/photo-1527661591475-527312dd65f5?auto=format&fit=crop&w=400&q=80' },
                { id: '7', category: 'bakery', name: 'Butter Croissant', desc: 'Flaky baked daily French croissant.', price: 4.00, badge: 'Fresh', img: 'https://images.unsplash.com/photo-1555507036-ab1f4038808a?auto=format&fit=crop&w=400&q=80' },
                { id: '8', category: 'bakery', name: 'Avocado Toast', desc: 'Sourdough bread, fresh avocado, chili flakes.', price: 8.50, badge: '', img: 'https://images.unsplash.com/photo-1588137378633-dea1336ce1e2?auto=format&fit=crop&w=400&q=80' }
            ];
    
            let cart = [];
            let fulfillmentMethod = 'delivery'; // Current fulfillment tracking setup parameter
    
            const menuContainer = document.getElementById('menu-container');
            const cartList = document.getElementById('cart-list');
            const cartBadge = document.getElementById('cart-badge');
            const cartSubtotal = document.getElementById('cart-subtotal');
            const cartTotal = document.getElementById('cart-total');
            const checkoutBtn = document.getElementById('checkout-btn');
    
            document.addEventListener('DOMContentLoaded', () => {
                renderMenu('all');
                updateCartUI(); // Maps layout and summary figures on loading parameters boundary
            });
    
            // Render Menu Items according to Category Parameters
            function renderMenu(category) {
                const filtered = category === 'all' ? menuItems : menuItems.filter(item => item.category === category);
    
                if (filtered.length === 0) {
                    menuContainer.innerHTML = `<div class="col-12 text-center py-5 text-muted"><p>No items found matching this category selection loop.</p></div>`;
                    return;
                }
    
                menuContainer.innerHTML = filtered.map(item => `
                    <div class="col-12 col-sm-6 col-lg-3">
                      <div class="product-card h-100 d-flex flex-column">
                        <div class="product-img-box">
                          ${item.badge ? `<span class="badge-green">${item.badge}</span>` : ''}
                          <img src="${item.img}" alt="${item.name}">
                        </div>
                        <div class="p-3 d-flex flex-column flex-grow-1">
                          <h6 class="fw-bold text-dark mb-1">${item.name}</h6>
                          <p class="text-muted small mb-3 flex-grow-1">${item.desc}</p>
                          <div class="d-flex align-items-center justify-content-between mt-auto">
                            <span class="fw-bold fs-5" style="color: var(--primary-green);">$${item.price.toFixed(2)}</span>
                            <button class="btn btn-outline-green btn-sm rounded-pill px-3" onclick="addToCart('${item.id}')">
                              + Add
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                `).join('');
            }
    
            // Integrated Filter Trigger Function matching tab link calls execution parameters
            function filterCategory(cat) {
                renderMenu(cat);
            }
    
            // Swap state behavior switches driven by interactive radio picker input updates
            function changeFulfillment(method) {
                fulfillmentMethod = method;
                updateCartUI();
            }
    
            // State Machine Operations for Active User Order arrays modifications
            function addToCart(id) {
                const product = menuItems.find(p => p.id === id);
                const existing = cart.find(item => item.id === id);
    
                if (existing) {
                    existing.qty += 1;
                } else {
                    cart.push({ ...product, qty: 1 });
                }
    
                updateCartUI();
                const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(document.getElementById('cartOffcanvas'));
                bsOffcanvas.show();
            }
    
            function updateQty(id, delta) {
                const item = cart.find(i => i.id === id);
                if (item) {
                    item.qty += delta;
                    if (item.qty <= 0) cart = cart.filter(i => i.id !== id);
                }
                updateCartUI();
            }
    
            // Synchronized User Calculation Interface Redraw engine pipeline
            function updateCartUI() {
                const totalItems = cart.reduce((sum, item) => sum + item.qty, 0);
                const subtotal = cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                const discountRate = 0.10; // Flat discount valuation metrics (10%)
                const discountValue = subtotal * discountRate;
                
                let deliveryFee = 0.00;
                if (fulfillmentMethod === 'delivery' && totalItems > 0) {
                    deliveryFee = 5.00;
                }
    
                const finalTotal = Math.max(0, subtotal - discountValue + deliveryFee);
    
                // Sync layout dynamic counters configurations triggers elements inside navbar
                if (totalItems > 0) {
                    cartBadge.textContent = totalItems;
                    cartBadge.classList.remove('d-none');
                    checkoutBtn.disabled = false;
                } else {
                    cartBadge.classList.add('d-none');
                    checkoutBtn.disabled = true;
                }
    
                // Draw line items cards representation into target offcanvas components
                if (cart.length === 0) {
                    cartList.innerHTML = `<p class="text-muted text-center py-5">Your cart is empty.</p>`;
                } else {
                    cartList.innerHTML = cart.map(item => `
                      <div class="d-flex align-items-center justify-content-between mb-3 bg-light p-2 rounded-3 border">
                        <img src="${item.img}" class="cart-thumb me-2" alt="${item.name}">
                        <div class="flex-grow-1 me-2">
                          <h6 class="mb-0 text-dark small fw-bold">${item.name}</h6>
                          <span class="small fw-bold" style="color: var(--primary-green);">$${(item.price * item.qty).toFixed(2)}</span>
                        </div>
                        <div class="btn-group btn-group-sm">
                          <button class="btn btn-outline-secondary py-0 px-2" onclick="updateQty('${item.id}', -1)">-</button>
                          <span class="btn btn-outline-secondary disabled py-0 px-2 text-dark">${item.qty}</span>
                          <button class="btn btn-outline-secondary py-0 px-2" onclick="updateQty('${item.id}', 1)">+</button>
                        </div>
                      </div>
                    `).join('');
                }
    
                // Updates display blocks formatting configurations in response to active variables sets
                const deliveryBlock = document.getElementById('delivery-info-block');
                const pickupBlock = document.getElementById('pickup-info-block');
                const feeRow = document.getElementById('fee-row');
    
                if (fulfillmentMethod === 'delivery') {
                    deliveryBlock.classList.remove('d-none');
                    pickupBlock.classList.add('d-none');
                    feeRow.classList.remove('d-none');
                } else {
                    deliveryBlock.classList.add('d-none');
                    pickupBlock.classList.remove('d-none');
                    feeRow.classList.add('d-none');
                }
    
                // Sync invoicing calculations metrics targets lines numbers format strings
                cartSubtotal.textContent = `$${subtotal.toFixed(2)}`;
                document.getElementById('cart-discount').textContent = `-$${discountValue.toFixed(2)}`;
                document.getElementById('cart-fee').textContent = `$${deliveryFee.toFixed(2)}`;
                cartTotal.textContent = `$${finalTotal.toFixed(2)}`;
            }
    
            // Checkout function triggers programmatic beautiful Bootstrap Toasts
            function checkout() {
                const toastEl = document.getElementById('checkoutToast');
                const toastMessage = document.getElementById('toastMessage');
                
                toastMessage.innerHTML = `<i class="bi bi-check-circle-fill me-2"></i> Order submitted successfully for <strong>${fulfillmentMethod.toUpperCase()}</strong> fulfillment setup configuration!`;
                
                const toast = new bootstrap.Toast(toastEl);
                toast.show();
    
                // Clear operational global array setup parameter properties
                cart = [];
                updateCartUI();
    
                // Dismiss offcanvas element safely
                const bsOffcanvas = bootstrap.Offcanvas.getInstance(document.getElementById('cartOffcanvas'));
                if (bsOffcanvas) bsOffcanvas.hide();
            }
    </script>
</body>

</html>