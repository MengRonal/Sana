@extends('layout.admin')

@section('content')

<!-- Financial Summary Dashboard (Other Income Focused) -->
<div class="row mb-3 g-2">
    <!-- 1. Other Income -->
    <div class="col-md-4">
        <div class="card text-bg-success text-white shadow-sm">
            <div class="card-body p-3 text-center">
                <div class="small fw-semibold">Total Other Income (ចំណូលផ្សេងៗសរុប)</div>
                <h4 class="mb-0 fw-bold">${{ number_format($otherIncome ?? 0, 2) }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center bg-white">
        <h5 class="mb-0 text-success"><i class="fa fa-arrow-up"></i> Other Income Management</h5>
        <div>
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Manage Categories</button>
            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                <i class="fa fa-plus"></i> New Income
            </button>
        </div>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" action="{{ route('admin.incomes') }}" class="row g-2 mb-3">
            <div class="col-auto">
                <select name="category_id" class="form-select form-select-sm">
                    <option value="">All Categories</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" @selected(request('category_id') == $c->id)>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <input type="date" name="from" value="{{ request('from') }}" class="form-control form-control-sm">
            </div>
            <div class="col-auto">
                <input type="date" name="to" value="{{ request('to') }}" class="form-control form-control-sm">
            </div>
            <div class="col-auto">
                <button class="btn btn-outline-secondary btn-sm">Filter</button>
            </div>
        </form>

        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Category</th>
                    <th>Amount</th>
                    <th>Note</th>
                    <th>By</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $key => $t)
                    <tr>
                        <td>{{ $transactions->firstItem() + $key }}</td>
                        <td>{{ $t->category->name ?? '-' }}</td>
                        <td class="text-success fw-bold">${{ number_format($t->amount, 2) }}</td>
                        <td>{{ $t->note }}</td>
                        <td>{{ $t->user->name ?? '-' }}</td>
                        <td>{{ $t->transaction_date ? \Carbon\Carbon::parse($t->transaction_date)->format('Y-m-d H:i') : '-' }}</td>
                        <td class="text-end">
                            <form action="{{ route('expense_income.destroy', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this transaction?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center text-muted">No income records found.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $transactions->links() }}
    </div>
</div>

<!-- Add Income Modal -->
<div class="modal fade" id="addTransactionModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('expense_income.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">New Other Income</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Select category --</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" step="0.01" name="amount" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="datetime-local" name="transaction_date" class="form-control" value="{{ date('Y-m-d\TH:i') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Note (optional)</label>
                    <textarea name="note" class="form-control" rows="2" placeholder="e.g. Commission, Interest..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success">Save Income</button>
            </div>
        </form>
    </div>
</div>

<!-- Manage Categories Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Income Categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group mb-3" style="max-height: 240px; overflow-y: auto;">
                    @foreach($categories as $c)
                        <li class="list-group-item d-flex justify-content-between align-items-center py-2">
                            <span>{{ $c->name }}</span>
                            <form action="{{ route('accounting-category.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Delete category?')" class="m-0">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-2">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>

                <form action="{{ route('accounting-category.store') }}" method="POST" class="row g-2">
                    @csrf
                    <input type="hidden" name="id_type" value="1"> <!-- 1 = Income -->
                    <div class="col-8">
                        <input type="text" name="name" class="form-control" placeholder="Category name" required>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-success w-100">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection