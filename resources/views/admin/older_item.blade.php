@extends('layout.admin')

@section('content')

<style>
    .oi-page-bg { background: #f3f4f6; min-height: 100vh; padding: 24px; }
    .oi-topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 16px; flex-wrap: wrap; }
    .oi-page-title { font-size: 20px; font-weight: 700; color: #111827; margin: 0; }
    .btn-add-oi { background: #2563eb; border: none; color: #fff; padding: 10px 18px; border-radius: 8px; font-weight: 500; font-size: 14px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; }
    .btn-add-oi:hover { background: #1d4ed8; color: #fff; }
    .oi-card { background: #fff; border-radius: 14px; border: none; box-shadow: 0 1px 3px rgba(0,0,0,.06); padding: 24px; }
    .oi-search-form { display: flex; justify-content: flex-end; gap: 0; margin-bottom: 18px; }
    .oi-search-form .form-control { border-radius: 8px 0 0 8px; border: 1px solid #e5e7eb; min-width: 260px; font-size: 14px; }
    .oi-search-form .btn-search { border-radius: 0 8px 8px 0; background: #2563eb; border: 1px solid #2563eb; color: #fff; font-size: 14px; padding: 6px 20px; }
    .oi-search-form .btn-search:hover { background: #1d4ed8; }
    .oi-table { width: 100%; border-collapse: collapse; }
    .oi-table thead th { text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: .03em; padding: 10px 12px; border-bottom: 1px solid #e5e7eb; white-space: nowrap; }
    .oi-table tbody td { padding: 12px; font-size: 14px; color: #111827; border-bottom: 1px solid #f1f2f4; vertical-align: middle; }
    .oi-table tbody tr:hover { background: #f9fafb; }
    .btn-edit-sm { background: #f59e0b; border: none; color: #fff; padding: 5px 12px; border-radius: 6px; font-size: 12.5px; font-weight: 500; text-decoration: none; display: inline-block; }
    .btn-edit-sm:hover { background: #d97706; color: #fff; }
    .btn-delete-sm { background: #ef4444; border: none; color: #fff; padding: 5px 12px; border-radius: 6px; font-size: 12.5px; font-weight: 500; }
    .btn-delete-sm:hover { background: #dc2626; }
    .oi-pagination nav p { display: none !important; }
    .oi-pagination { display: flex; justify-content: flex-end; margin-top: 18px; }
    .oi-pagination .page-link { border-radius: 8px !important; border: 1px solid #e5e7eb; color: #374151; font-size: 13px; min-width: 32px; text-align: center; }
    .oi-pagination .page-item.active .page-link { background: #2563eb; border-color: #2563eb; color: #fff; }
</style>

<div class="oi-page-bg">

    <div class="oi-topbar">
        <h4 class="oi-page-title">Order Item List</h4>
        <a href="{{ route('order_items.create') }}" class="btn-add-oi">
            <i class="fa fa-plus"></i> Add New Order Item
        </a>
    </div>

    <div class="oi-card">

        <form action="{{ route('order_items.index') }}" method="GET" class="oi-search-form">
            <input type="text" name="search" class="form-control" placeholder="Search order item..." value="{{ request('search') }}">
            <button class="btn-search" type="submit">Search</button>
        </form>

        <div class="table-responsive">
            <table class="oi-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Order</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th style="width:180px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orderItems as $row)
                        <tr>
                            <td>{{ $row->order_item_id }}</td>
                            <td>#{{ $row->order_id }}</td>
                            <td>{{ $row->product->product_name ?? '-' }}</td>
                            <td>{{ $row->quantity ?? '-' }}</td>
                            <td>{{ $row->price !== null ? number_format($row->price, 2) : '-' }}</td>
                            <td>{{ ($row->price !== null && $row->quantity !== null) ? number_format($row->price * $row->quantity, 2) : '-' }}</td>
                            <td>
                                <a href="{{ route('order_items.edit', $row->order_item_id) }}" class="btn-edit-sm">Edit</a>

                                <form action="{{ route('order_items.destroy', $row->order_item_id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete-sm btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">No order items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="oi-pagination">
            {{ $orderItems->links('pagination::simple-bootstrap-5') }}
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
            const Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true,
                didOpen: (toast) => { toast.addEventListener('mouseenter', Swal.stopTimer); toast.addEventListener('mouseleave', Swal.resumeTimer); } });
            Toast.fire({ icon: 'success', title: "{{ session('success') }}" });
        @endif

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.delete-form');
                Swal.fire({ title: 'Are you sure?', text: "You won't be able to revert this!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Yes, delete it!' })
                    .then((result) => { if (result.isConfirmed) form.submit(); });
            });
        });
    });
</script>

@endsection