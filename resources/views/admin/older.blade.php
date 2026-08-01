@extends('layout.admin')

@section('content')

<style>
    .ord-page-bg { background: #f3f4f6; min-height: 100vh; padding: 24px; }
    .ord-topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; gap: 16px; flex-wrap: wrap; }
    .ord-page-title { font-size: 20px; font-weight: 700; color: #111827; margin: 0; }
    .btn-add-order { background: #2563eb; border: none; color: #fff; padding: 10px 18px; border-radius: 8px; font-weight: 500; font-size: 14px; text-decoration: none; display: inline-flex; align-items: center; gap: 6px; transition: background .15s ease; }
    .btn-add-order:hover { background: #1d4ed8; color: #fff; }
    .ord-card { background: #fff; border-radius: 14px; border: none; box-shadow: 0 1px 3px rgba(0,0,0,.06); padding: 24px; }
    .ord-search-form { display: flex; justify-content: flex-end; gap: 0; margin-bottom: 18px; }
    .ord-search-form .form-control { border-radius: 8px 0 0 8px; border: 1px solid #e5e7eb; min-width: 260px; font-size: 14px; }
    .ord-search-form .btn-search { border-radius: 0 8px 8px 0; background: #2563eb; border: 1px solid #2563eb; color: #fff; font-size: 14px; padding: 6px 20px; }
    .ord-search-form .btn-search:hover { background: #1d4ed8; }
    .ord-table { width: 100%; border-collapse: collapse; }
    .ord-table thead th { text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: .03em; padding: 10px 12px; border-bottom: 1px solid #e5e7eb; white-space: nowrap; }
    .ord-table tbody td { padding: 12px; font-size: 14px; color: #111827; border-bottom: 1px solid #f1f2f4; vertical-align: middle; }
    .ord-table tbody tr:hover { background: #f9fafb; }
    .ord-badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 11.5px; font-weight: 600; }
    .ord-badge.paid { background: #dcfce7; color: #15803d; }
    .ord-badge.unpaid { background: #fee2e2; color: #b91c1c; }
    .btn-edit-sm { background: #f59e0b; border: none; color: #fff; padding: 5px 12px; border-radius: 6px; font-size: 12.5px; font-weight: 500; text-decoration: none; display: inline-block; }
    .btn-edit-sm:hover { background: #d97706; color: #fff; }
    .btn-delete-sm { background: #ef4444; border: none; color: #fff; padding: 5px 12px; border-radius: 6px; font-size: 12.5px; font-weight: 500; }
    .btn-delete-sm:hover { background: #dc2626; }
    .ord-pagination nav p { display: none !important; }
    .ord-pagination { display: flex; justify-content: flex-end; margin-top: 18px; }
    .ord-pagination .page-link { border-radius: 8px !important; border: 1px solid #e5e7eb; color: #374151; font-size: 13px; min-width: 32px; text-align: center; }
    .ord-pagination .page-item.active .page-link { background: #2563eb; border-color: #2563eb; color: #fff; }
</style>

<div class="ord-page-bg">

    <div class="ord-topbar">
        <h4 class="ord-page-title">Order List</h4>
        <a href="{{ route('orders.create') }}" class="btn-add-order">
            <i class="fa fa-plus"></i> Add New Order
        </a>
    </div>

    <div class="ord-card">

        <form action="{{ route('orders.index') }}" method="GET" class="ord-search-form">
            <input type="text" name="search" class="form-control" placeholder="Search order..." value="{{ request('search') }}">
            <button class="btn-search" type="submit">Search</button>
        </form>

        <div class="table-responsive">
            <table class="ord-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Cashier</th>
                        <th>Order Type</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Final Price</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th style="width:180px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $row)
                        <tr>
                            <td>{{ $row->order_id }}</td>
                            <td>{{ $row->customer->name ?? '-' }}</td>
                            <td>{{ $row->cashier->name ?? '-' }}</td>
                            <td>{{ $row->orderType->order_name ?? '-' }}</td>
                            <td>{{ $row->total_amount !== null ? number_format($row->total_amount, 2) : '-' }}</td>
                            <td>{{ $row->discount !== null ? number_format($row->discount, 2) : '-' }}</td>
                            <td>{{ $row->final_price !== null ? number_format($row->final_price, 2) : '-' }}</td>
                            <td>
                                @if($row->is_paid)
                                    <span class="ord-badge paid">Paid</span>
                                @else
                                    <span class="ord-badge unpaid">Unpaid</span>
                                @endif
                            </td>
                            <td>{{ $row->payment_status ?? '-' }}</td>
                            <td>
                                <a href="{{ route('orders.edit', $row->order_id) }}" class="btn-edit-sm">Edit</a>

                                <form action="{{ route('orders.destroy', $row->order_id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete-sm btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center text-muted py-4">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="ord-pagination">
            {{ $orders->links('pagination::simple-bootstrap-5') }}
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