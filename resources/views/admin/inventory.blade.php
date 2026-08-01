@extends('layout.admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Inventory / Stock Logs</h5>
        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#adjustStockModal">
            <i class="fa fa-plus"></i> Manual Adjustment
        </button>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" class="row g-2 mb-3">
            <div class="col-auto">
                <select name="product_id" class="form-select form-select-sm">
                    <option value="">All products</option>
                    @foreach($products as $p)
                        <option value="{{ $p->product_id }}" @selected(request('product_id') == $p->product_id)>{{ $p->product_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <select name="type" class="form-select form-select-sm">
                    <option value="">All types</option>
                    <option value="in" @selected(request('type') == 'in')>Stock In</option>
                    <option value="out" @selected(request('type') == 'out')>Stock Out</option>
                </select>
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
                    <th>Type</th>
                    <th>Qty</th>
                    <th>Reason</th>
                    <th>Note</th>
                    <th>By</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                    <tr>
                        <td>{{ $log->log_id }}</td>
                        <td>{{ $log->product->product_name ?? '-' }}</td>
                        <td>
                            @if($log->type === 'in')
                                <span class="badge bg-success">In</span>
                            @else
                                <span class="badge bg-danger">Out</span>
                            @endif
                        </td>
                        <td>{{ $log->quantity }}</td>
                        <td>{{ ucfirst($log->reason) }}</td>
                        <td>{{ $log->note }}</td>
                        <td>{{ $log->user->name ?? '-' }}</td>
                        <td>{{ $log->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted">No stock movements yet.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $logs->links() }}
    </div>
</div>

<!-- Manual Adjustment Modal -->
<div class="modal fade" id="adjustStockModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('inventory.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Manual Stock Adjustment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
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
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select" required>
                            <option value="in">Stock In</option>
                            <option value="out">Stock Out</option>
                        </select>
                    </div>
                    <div class="col mb-3">
                        <label class="form-label">Quantity</label>
                        <input type="number" name="quantity" min="1" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Reason</label>
                    <input type="text" name="reason" class="form-control" placeholder="e.g. damaged, correction, stock take" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Note (optional)</label>
                    <textarea name="note" class="form-control" rows="2"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection