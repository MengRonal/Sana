<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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