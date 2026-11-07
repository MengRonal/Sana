@extends('layout.admin')

@section('content')

<style>
    .prod-page-bg {
        background: #f3f4f6;
        min-height: 100vh;
        padding: 24px;
    }

    .prod-topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        gap: 16px;
        flex-wrap: wrap;
    }

    .prod-page-title {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .prod-top-actions { display: flex; gap: 10px; align-items: center; }

    .btn-add-product,
    .btn-print {
        border: none;
        color: #fff;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 500;
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        cursor: pointer;
        transition: background .15s ease;
    }
    .btn-add-product { background: #2563eb; }
    .btn-add-product:hover { background: #1d4ed8; color: #fff; }
    .btn-print { background: #059669; }
    .btn-print:hover { background: #047857; color: #fff; }

    .prod-card {
        background: #fff;
        border-radius: 14px;
        border: none;
        box-shadow: 0 1px 3px rgba(0,0,0,.06);
        padding: 24px;
    }

    .prod-search-form {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 10px;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }
    .prod-search-form .form-select,
    .prod-search-form .form-control {
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        font-size: 14px;
        height: 42px;
    }
    .prod-search-form .form-select { min-width: 150px; max-width: 200px; }
    .prod-search-form .form-control { min-width: 240px; max-width: 320px; }
    .prod-search-form .btn-search {
        border-radius: 8px;
        background: #2563eb;
        border: 1px solid #2563eb;
        color: #fff;
        font-size: 14px;
        padding: 0 20px;
        height: 42px;
    }
    .prod-search-form .btn-search:hover { background: #1d4ed8; }
    .prod-search-form .btn-clear {
        border-radius: 8px;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        color: #374151;
        font-size: 14px;
        padding: 0 16px;
        height: 42px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }
    .prod-search-form .btn-clear:hover { background: #e5e7eb; color: #111827; }

    .prod-table { width: 100%; border-collapse: collapse; }
    .prod-table thead th {
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: .03em;
        padding: 10px 12px;
        border-bottom: 1px solid #e5e7eb;
        background: transparent;
        white-space: nowrap;
    }
    .prod-table tbody td {
        padding: 12px;
        font-size: 14px;
        color: #111827;
        border-bottom: 1px solid #f1f2f4;
        vertical-align: middle;
    }
    .prod-table tbody tr:hover { background: #f9fafb; }

    .prod-thumb {
        width: 42px;
        height: 42px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #e5e7eb;
        background: #f3f4f6;
    }

    .prod-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 600;
    }
    .prod-badge.active   { background: #dcfce7; color: #15803d; }
    .prod-badge.inactive { background: #fee2e2; color: #b91c1c; }
    .prod-badge.stock    { background: #dbeafe; color: #1d4ed8; }
    .prod-badge.nonstock { background: #f3f4f6; color: #4b5563; }

    .prod-action-group { display: flex; align-items: center; gap: 6px; }
    .btn-icon-edit,
    .btn-icon-delete {
        background: transparent;
        border: none;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        padding: 0;
    }
    .btn-icon-edit { color: #d97706; }
    .btn-icon-edit:hover { background: #fef3c7; color: #b45309; }
    .btn-icon-delete { color: #dc2626; }
    .btn-icon-delete:hover { background: #fee2e2; color: #b91c1c; }

    .prod-pagination nav p { display: none !important; }
    .prod-pagination {
        display: flex;
        justify-content: flex-end;
        margin-top: 18px;
    }
    .prod-pagination .pagination { gap: 4px; }
    .prod-pagination .page-link {
        border-radius: 8px !important;
        border: 1px solid #e5e7eb;
        color: #374151;
        font-size: 13px;
        min-width: 32px;
        text-align: center;
    }
    .prod-pagination .page-item.active .page-link {
        background: #2563eb;
        border-color: #2563eb;
        color: #fff;
    }

    .print-header { display: none; }

    /* ===== Print styles ===== */
    @media print {
        .no-print,
        .sidebar, .navbar, nav, header, footer, aside,
        .prod-pagination,
        .swal2-container { display: none !important; }

        body { background: #fff !important; }

        /* Hide everything from the layout (Dashboard header, Settings, Sign Out, sidebar...) */
        body * { visibility: hidden; }
        .prod-page-bg,
        .prod-page-bg * { visibility: visible; }
        .prod-page-bg {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .prod-page-bg .no-print,
        .prod-page-bg .no-print * { visibility: hidden !important; }

        .prod-page-bg { background: #fff; padding: 0; min-height: auto; }
        .prod-card { box-shadow: none; padding: 0; }

        .print-header { display: block; text-align: center; margin-bottom: 18px; }
        .print-header .print-brand {
            margin: 0 0 6px;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: .12em;
            color: #111827;
        }
        .print-header h3 { margin: 0 0 4px; font-size: 16px; font-weight: 600; }
        .print-header p { margin: 0; font-size: 12px; color: #4b5563; }

        .prod-table th, .prod-table td { font-size: 11px; padding: 6px; }
        .prod-table th:last-child,
        .prod-table td:last-child { display: none; } /* hide Action column */
    }
</style>

<div class="prod-page-bg">

    <div class="prod-topbar no-print">
        <h4 class="prod-page-title">Product List</h4>

        <div class="prod-top-actions">
            <button type="button" class="btn-print" onclick="window.print()">
                <i class="fa fa-print"></i> Print
            </button>

            <a href="{{ route('products.create') }}" class="btn-add-product">
                <i class="fa fa-plus"></i> Add New Product
            </a>
        </div>
    </div>

    <div class="prod-card">

        {{-- Shown only when printing --}}
        <div class="print-header">
            <h2 class="print-brand">CK COFFEE</h2>
            <h3>Product List</h3>
            <p>Printed on {{ now()->format('d/m/Y H:i') }}</p>
        </div>

        <form action="{{ route('products.index') }}" method="GET" class="prod-search-form no-print" id="searchForm">

            <select name="category" id="category" class="form-select">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->category_id }}"
                        {{ (string) request('category') === (string) $cat->category_id ? 'selected' : '' }}>
                        {{ $cat->category_name }}
                    </option>
                @endforeach
            </select>

            <select name="type" id="type" class="form-select">
                <option value="">All Types</option>
                <option value="1" {{ request('type') === '1' ? 'selected' : '' }}>Stock</option>
                <option value="0" {{ request('type') === '0' ? 'selected' : '' }}>Non-Stock</option>
            </select>

            <select name="status" id="status" class="form-select">
                <option value="">All Status</option>
                @foreach($statuses as $st)
                    <option value="{{ $st }}" {{ request('status') === $st ? 'selected' : '' }}>
                        {{ ucfirst($st) }}
                    </option>
                @endforeach
            </select>

            <input type="text" name="search" id="search" class="form-control"
                   placeholder="Search product..." value="{{ request('search') }}">

            <button type="submit" class="btn-search">Filter</button>

            @if(request('search') || request('category') || request()->filled('type') || request('status'))
                <a href="{{ route('products.index') }}" class="btn-clear">Clear</a>
            @endif
        </form>

        <div class="table-responsive">
            <table class="prod-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Product Type</th>
                        <th>Status</th>
                        <th class="no-print" style="width:90px; text-align:right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $row)
                        <tr>
                            <td>{{ $row->product_id }}</td>
                            <td>
                                @if($row->image)
                                    <img src="{{ asset('images/' . $row->image) }}"
                                         alt="{{ $row->product_name }}"
                                         class="prod-thumb">
                                @else
                                    <div class="prod-thumb"></div>
                                @endif
                            </td>
                            <td>{{ $row->product_name }}</td>
                            <td>{{ $row->category->category_name ?? '-' }}</td>
                            <td>{{ $row->supplier->name ?? '-' }}</td>
                            <td>${{ $row->price !== null ? number_format($row->price, 2) : '-' }}</td>
                            <td>{{ $row->qty ?? '-' }}</td>
                            <td>
                                @if((string) $row->product_type === '1')
                                    <span class="prod-badge stock">Stock</span>
                                @elseif((string) $row->product_type === '0')
                                    <span class="prod-badge nonstock">Non-Stock</span>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if(strtolower($row->status ?? '') === 'active')
                                    <span class="prod-badge active">Active</span>
                                @elseif($row->status)
                                    <span class="prod-badge inactive">{{ $row->status }}</span>
                                @else
                                    <span class="prod-badge inactive">-</span>
                                @endif
                            </td>
                            <td class="no-print">
                                <div class="prod-action-group">
                                    <a href="{{ route('products.edit', $row->product_id) }}" class="btn-icon-edit" title="Edit product">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </a>

                                    <form action="{{ route('products.destroy', $row->product_id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn-icon-delete btn-delete" title="Delete product">
                                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                                <path d="M10 11v6"></path>
                                                <path d="M14 11v6"></path>
                                                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="prod-pagination no-print">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        });

        // 1. Success message
        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: @json(session('success'))
            });
        @endif

        // 2. Error message (product is in use and cannot be deleted)
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Cannot Delete',
                text: @json(session('error')),
                confirmButtonText: 'OK',
                confirmButtonColor: '#2563eb'
            });
        @endif

        // 3. Confirmation before delete
        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.delete-form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to delete this product?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // 4. Auto-submit when a dropdown filter changes
        ['category', 'type', 'status'].forEach(id => {
            document.getElementById(id).addEventListener('change', function () {
                document.getElementById('searchForm').submit();
            });
        });
    });
</script>

@endsection