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

    .prod-card {
        background: #fff;
        border-radius: 14px;
        border: none;
        box-shadow: 0 1px 3px rgba(0,0,0,.06);
        padding: 24px;
    }

    .prod-search-form {
        margin-bottom: 18px;
    }
    .prod-search-form .row {
        --bs-gutter-x: 10px;
        align-items: center;
        display: flex;
        flex-wrap: wrap;
    }

    .prod-search-form .form-select,
    .prod-search-form .form-control {
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        font-size: 14px;
        height: 42px;
        width: 100%;
    }

    .prod-search-form .btn-search {
        border-radius: 8px;
        background: #2563eb;
        border: 1px solid #2563eb;
        color: #fff;
        font-size: 14px;
        padding: 0 14px;
        height: 42px;
        width: auto;
        white-space: nowrap;
    }
    .prod-search-form .btn-search:hover { background: #1d4ed8; }

    .prod-search-form .btn-clear {
        border-radius: 8px;
        background: #f3f4f6;
        border: 1px solid #e5e7eb;
        color: #374151;
        font-size: 14px;
        padding: 0 14px;
        height: 42px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: auto;
        white-space: nowrap;
    }
    .prod-search-form .btn-clear:hover { background: #e5e7eb; color: #111827; }

    /* Keep filters on one row, stretch to fill full width, buttons stay compact */
    @media (min-width: 768px) {
        .prod-search-form .row {
            flex-wrap: nowrap;
            width: 100%;
        }
        .prod-search-form .row > [class*="col-"] {
            flex: 1 1 0;
            min-width: 0;
        }
        .prod-search-form .row > .col-filter-btn,
        .prod-search-form .row > .col-clear-btn {
            flex: 0 0 auto;
        }
        .prod-search-form select.form-select,
        .prod-search-form input.form-control {
            width: 100%;
        }
    }

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

    /* Order status badges */
    .order-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 11.5px;
        font-weight: 600;
        white-space: nowrap;
    }
    .order-badge.pending   { background: #fef3c7; color: #92400e; }
    .order-badge.paid      { background: #dbeafe; color: #1d4ed8; }
    .order-badge.completed { background: #dcfce7; color: #15803d; }
    .order-badge.cancelled { background: #fee2e2; color: #b91c1c; }
    .order-badge.refunded  { background: #f3e8ff; color: #7e22ce; }

    .btn-view-sm {
        background: #eef2ff;
        border: none;
        color: #4f46e5;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12.5px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
    }
    .btn-view-sm:hover { background: #e0e7ff; color: #4338ca; }

    .btn-edit-sm {
        background: #f59e0b;
        border: none;
        color: #fff;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12.5px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
    }
    .btn-edit-sm:hover { background: #d97706; color: #fff; }

    .btn-delete-sm {
        background: #ef4444;
        border: none;
        color: #fff;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12.5px;
        font-weight: 500;
    }
    .btn-delete-sm:hover { background: #dc2626; }

    .btn-icon-delete {
        background: transparent;
        border: none;
        color: #dc2626;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-icon-delete:hover { background: #fee2e2; }

    .order-summary-cards {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }
    .order-summary-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,.06);
        padding: 18px 20px;
    }
    .order-summary-card .label { font-size: 12.5px; color: #6b7280; margin-bottom: 6px; }
    .order-summary-card .value { font-size: 22px; font-weight: 700; color: #111827; }
    .order-summary-card.pending .value   { color: #b45309; }
    .order-summary-card.completed .value { color: #15803d; }
    .order-summary-card.revenue .value   { color: #2563eb; }

    .prod-pagination { display: flex; justify-content: flex-end; margin-top: 18px; }
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
</style>

<div class="prod-page-bg">

    <div class="prod-topbar">
        <h4 class="prod-page-title">Order List</h4>
    </div>

    {{-- Summary cards --}}
    <div class="order-summary-cards">
        <div class="order-summary-card">
            <div class="label">Total Orders</div>
            <div class="value">{{ $summary['total'] ?? 0 }}</div>
        </div>
        <div class="order-summary-card pending">
            <div class="label">Pending</div>
            <div class="value">{{ $summary['pending'] ?? 0 }}</div>
        </div>
        <div class="order-summary-card completed">
            <div class="label">Completed</div>
            <div class="value">{{ $summary['completed'] ?? 0 }}</div>
        </div>
        <div class="order-summary-card revenue">
            <div class="label">Revenue Today</div>
            <div class="value">${{ number_format($summary['revenue_today'] ?? 0, 2) }}</div>
        </div>
    </div>

    <div class="prod-card">

        <form action="{{ route('orders.index') }}" method="GET" class="prod-search-form" id="searchForm">
            <div class="row g-2">
                <div class="col-12 col-md-auto">
                    <select name="status" id="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="paid"   {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    </select>
                </div>

                <div class="col-12 col-md-auto">
                    <input type="text" name="search" id="search" class="form-control"
                           placeholder="Search order or customer..." value="{{ request('search') }}">
                </div>

                <div class="col-12 col-md-auto">
                    <input type="date" name="start_date" class="form-control" placeholder="Start Date" value="{{ request('start_date') }}">
                </div>

                <div class="col-12 col-md-auto">
                    <input type="date" name="end_date" class="form-control" placeholder="End Date" value="{{ request('end_date') }}">
                </div>

                <div class="col-6 col-md-auto col-filter-btn">
                    <button type="submit" class="btn-search">Filter</button>
                </div>

                @if(request('search') || request('status') || request('start_date') || request('end_date'))
                    <div class="col-6 col-md-auto col-clear-btn">
                        <a href="{{ route('orders.index') }}" class="btn-clear">Clear</a>
                    </div>
                @endif
            </div>
        </form>

        <div class="table-responsive">
            <table class="prod-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Cashier</th>
                        <th>Order Type</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Final Price</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th style="width:70px; text-align:right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $row)
                        <tr>
                            <td>{{ $row->order_id }}</td>
                            <td>{{ $row->customer->name ?? '-' }}</td>
                            <td>{{ $row->cashier->name ?? '-' }}</td>
                            <td>{{ $row->orderType->order_name ?? '-' }}</td>
                            <td>{{ $row->order_items_count ?? 0 }}</td>
                            <td>${{ number_format($row->total_amount ?? 0, 2) }}</td>
                            <td>{{ number_format($row->discount ?? 0, 2) }}%</td>
                            <td>${{ number_format($row->final_price ?? 0, 2) }}</td>
                            <td>{{ $row->paymentMethod->name ?? '-' }}</td>
                            <td>
                                @php
                                    $statusText = $row->payment_status ?: ($row->is_paid ? 'Paid' : 'Pending');
                                    $statusKey  = strtolower($statusText);
                                    $knownKeys  = ['pending','paid','completed','cancelled','refunded'];
                                    $badgeClass = in_array($statusKey, $knownKeys) ? $statusKey : ($row->is_paid ? 'paid' : 'pending');
                                @endphp
                                <span class="order-badge {{ $badgeClass }}">{{ ucfirst($statusText) }}</span>
                            </td>
                            <td>{{ optional($row->order_date)->format('d M Y, h:i A') }}</td>
                            <td style="text-align:right;">
                                <form action="{{ route('orders.destroy', $row->order_id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-icon-delete btn-delete" title="Delete order">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                            <path d="M10 11v6"></path>
                                            <path d="M14 11v6"></path>
                                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center text-muted py-4">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="prod-pagination">
            {{ $orders->links('pagination::simple-bootstrap-5') }}
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        @if(session('success'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
        @endif

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Delete Order?',
                    text: "Do you want delete this Order?",
                    icon: 'delete',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Delete!'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });

        document.getElementById('search').addEventListener('keyup', function () {
            document.getElementById('searchForm').submit();
        });
        document.getElementById('status').addEventListener('change', function () {
            document.getElementById('searchForm').submit();
        });
    });
</script>

@endsection