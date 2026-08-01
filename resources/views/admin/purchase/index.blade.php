@extends('layout.admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Purchases</h5>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPurchaseModal">
            <i class="fa fa-plus"></i> New Purchase
        </button>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" class="row g-2 mb-3">
            <div class="col-auto">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control form-control-sm" placeholder="Search product...">
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-secondary btn-sm">Filter</button>
            </div>
        </form>

        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product</th>
                    <th>Supplier</th>
                    <th>Qty</th>
                    <th>Cost Price</th>
                    <th>Total</th>
                    <th>Purchased By</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($purchases as $purchase)
                    <tr>
                        <td>{{ $purchase->purchase_id }}</td>
                        <td>{{ $purchase->product->product_name ?? '-' }}</td>
                        <td>{{ $purchase->supplier->name ?? '-' }}</td>
                        <td>{{ $purchase->quantity }}</td>
                        <td>{{ number_format($purchase->cost_price, 2) }}</td>
                        <td>{{ number_format($purchase->total_cost, 2) }}</td>
                        <td>{{ $purchase->user->name ?? '-' }}</td>
                        <td>{{ $purchase->created_at->format('Y-m-d H:i') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.purchase.edit', $purchase->purchase_id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.purchase.destroy', $purchase->purchase_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this purchase?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="text-center text-muted">No purchases yet.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $purchases->links() }}
    </div>
</div>

<!-- Add Purchase Modal -->
<div class="modal fade" id="addPurchaseModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.purchase.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">New Purchase</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Supplier</label>
                    <select name="supplier_id" class="form-select" required>
                        <option value="">-- Select supplier --</option>
                        @foreach($suppliers as $s)
                            <option value="{{ $s->supplier_id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Product</label>
                    <select name="product_id" class="form-select" required>
                        <option value="">-- Select product --</option>
                        @foreach($products as $p)
                            <option value="{{ $p->product_id }}">{{ $p->product_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" min="1" class="form-control" required>
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Cost Price (per unit)</label>
                        <input type="number" step="0.01" name="cost_price" class="form-control" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save Purchase</button>
            </div>
        </form>
    </div>
</div>
@endsection