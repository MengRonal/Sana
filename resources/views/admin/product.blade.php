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

    .btn-add-product {
        background: #2563eb;
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
        transition: background .15s ease;
    }
    .btn-add-product:hover {
        background: #1d4ed8;
        color: #fff;
    }

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
        gap: 0;
        margin-bottom: 18px;
    }
    .prod-search-form .form-control {
        border-radius: 8px 8px 8px 8px;
        border: 1px solid #e5e7eb;
        min-width: 280px;
        font-size: 16px;
    }
    .prod-search-form .btn-search {
        border-radius: 0 8px 8px 0;
        background: #2563eb;
        border: 1px solid #2563eb;
        color: #fff;
        font-size: 14px;
        padding: 6px 20px;
    }
    .prod-search-form .btn-search:hover {
        background: #1d4ed8;
    }

    .prod-table {
        width: 100%;
        border-collapse: collapse;
    }
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
    .prod-table tbody tr:hover {
        background: #f9fafb;
    }

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
    .prod-badge.active {
        background: #dcfce7;
        color: #15803d;
    }
    .prod-badge.inactive {
        background: #fee2e2;
        color: #b91c1c;
    }

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

    .prod-pagination nav p { display: none !important; }
    .prod-pagination {
        display: flex;
        justify-content: flex-end;
        margin-top: 18px;
    }
    .prod-pagination .pagination {
        gap: 4px;
    }
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
        <h4 class="prod-page-title">Product List</h4>

        <a href="{{ route('products.create') }}" class="btn-add-product">
            <i class="fa fa-plus"></i> Add New Product
        </a>
    </div>

    <div class="prod-card">

        <form action="{{ route('products.index') }}" method="GET" class="prod-search-form" id="searchForm">
               <div class="search-input-group">
                <input type="text" name="search" id="search" class="form-control" placeholder="Search product..." value="{{ request('search') }}">
                
            </div>
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
                        <th>Type</th>
                        <th>Status</th>
                        <th style="width:180px;">Action</th>
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
                            <td>{{ $row->price !== null ? number_format($row->price, 2) : '-' }}</td>
                            <td>{{ $row->qty ?? '-' }}</td>
                            <td>{{ $row->product_type ?? '-' }}</td>
                            <td>
                                @if(strtolower($row->status ?? '') === 'active')
                                    <span class="prod-badge active">Active</span>
                                @elseif($row->status)
                                    <span class="prod-badge inactive">{{ $row->status }}</span>
                                @else
                                    <span class="prod-badge inactive">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('products.edit', $row->product_id) }}" class="btn-edit-sm">
                                    Edit
                                </a>

                                <form action="{{ route('products.destroy', $row->product_id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete-sm btn-delete">
                                        Delete
                                    </button>
                                </form>
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

        <div class="prod-pagination">
            {{ $products->links('pagination::simple-bootstrap-5') }}
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

            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif

        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.delete-form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do you want delete Product !",
                    icon: 'delete',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
<script>
document.getElementById('search').addEventListener('keyup', function () {
    document.getElementById('searchForm').submit();
});
</script>

@endsection