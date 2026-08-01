@extends('layout.admin')

@section('content')
<div class="card">
    <div class="card-header"><h5 class="mb-0">Edit Purchase #{{ $purchase->purchase_id }}</h5></div>
    <div class="card-body">
        <form action="{{ route('admin.purchase.update', $purchase->purchase_id) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Supplier</label>
                <select name="supplier_id" class="form-select" required>
                    @foreach($suppliers as $s)
                        <option value="{{ $s->supplier_id }}" @selected($purchase->supplier_id == $s->supplier_id)>{{ $s->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Product</label>
                <select name="product_id" class="form-select" required>
                    @foreach($products as $p)
                        <option value="{{ $p->product_id }}" @selected($purchase->product_id == $p->product_id)>{{ $p->product_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <div class="col mb-3">
                    <label class="form-label">Quantity</label>
                    <input type="number" name="quantity" min="1" class="form-control" value="{{ $purchase->quantity }}" required>
                </div>
                <div class="col mb-3">
                    <label class="form-label">Cost Price</label>
                    <input type="number" step="0.01" name="cost_price" class="form-control" value="{{ $purchase->cost_price }}" required>
                </div>
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('admin.purchase.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection