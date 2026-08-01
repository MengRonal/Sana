@extends('layout.admin')

@section('content')

<div class="row mb-3">
    <div class="col-md-4">
        <div class="card text-bg-success">
            <div class="card-body">
                <div class="small">Total Income</div>
                <h4 class="mb-0">{{ number_format($totalIncome, 2) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-danger">
            <div class="card-body">
                <div class="small">Total Expense</div>
                <h4 class="mb-0">{{ number_format($totalExpense, 2) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-dark">
            <div class="card-body">
                <div class="small">Net Balance</div>
                <h4 class="mb-0">{{ number_format($totalIncome - $totalExpense, 2) }}</h4>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Expense / Income</h5>
        <div>
            <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Manage Categories</button>
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
                <i class="fa fa-plus"></i> New Transaction
            </button>
        </div>
    </div>

    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="GET" class="row g-2 mb-3">
            <div class="col-auto">
                <select name="category_id" class="form-select form-select-sm">
                    <option value="">All categories</option>
                    @foreach($categories as $c)
                        <option value="{{ $c->id }}" @selected(request('category_id') == $c->id)>
                            {{ $c->name }} ({{ $c->type->name ?? '' }})
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
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Note</th>
                    <th>By</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($transactions as $t)
                    <tr>
                        <td>{{ $t->id }}</td>
                        <td>{{ $t->category->name ?? '-' }}</td>
                        <td>
                            @if(($t->category->type->id_type ?? null) == 1)
                                <span class="badge bg-success">Income</span>
                            @else
                                <span class="badge bg-danger">Expense</span>
                            @endif
                        </td>
                        <td>{{ number_format($t->amount, 2) }}</td>
                        <td>{{ $t->note }}</td>
                        <td>{{ $t->user->name ?? '-' }}</td>
                        <td>{{ $t->transaction_date->format('Y-m-d H:i') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.expense_income.edit', $t->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.expense_income.destroy', $t->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this transaction?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="text-center text-muted">No transactions yet.</td></tr>
                @endforelse
            </tbody>
        </table>

        {{ $transactions->links() }}
    </div>
</div>

<!-- Add Transaction Modal -->
<div class="modal fade" id="addTransactionModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('expense_income.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">New Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Select category --</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->name }} ({{ $c->type->name ?? '' }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input type="number" step="0.01" name="amount" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Date</label>
                    <input type="datetime-local" name="transaction_date" class="form-control" required>
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

<!-- Manage Categories Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Accounting Categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group mb-3">
                    @foreach($categories as $c)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $c->name }} <span class="badge bg-secondary">{{ $c->type->name ?? '' }}</span>
                            <form action="{{ route('admin.accounting-category.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Delete category?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
                <form action="{{ route('accounting-category.store') }}" method="POST" class="row g-2">
                    @csrf
                    <div class="col-6">
                        <input type="text" name="name" class="form-control" placeholder="Category name" required>
                    </div>
                    <div class="col-4">
                        <select name="id_type" class="form-select" required>
                            <option value="1">Income</option>
                            <option value="2">Expense</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-primary w-100">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection