@extends('layout.admin')

@section('title','Products')
@section('page-title','☕ Products')
@section('topbar-actions')
  <a href="{{ route('products.create') }}" class="btn btn-primary">+ Add Product</a>
@endsection

@section('content')
<div class="card" style="margin-bottom:16px">
  <form method="GET" style="display:flex;gap:10px;align-items:flex-end;flex-wrap:wrap">
    <div class="form-group" style="margin:0;flex:1;min-width:160px">
      <label class="form-label">Search</label>
      <input class="form-input" name="search" value="{{ request('search') }}" placeholder="Product name...">
    </div>
    <div class="form-group" style="margin:0">
      <label class="form-label">Category</label>
      <select class="form-select" name="category">
        <option value="">All</option>
        @foreach($categories as $c)
        <option value="{{ $c->category_id }}" {{ request('category')==$c->category_id?'selected':'' }}>
          {{ $c->category_name }}
        </option>
        @endforeach
      </select>
    </div>
    <button class="btn btn-primary" type="submit">Search</button>
    <a href="{{ route('products.index') }}" class="btn btn-ghost">Reset</a>
  </form>
</div>

<div class="card">
  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>Product</th><th>Category</th><th>Price</th>
          <th>Stock</th><th>Type</th><th>Status</th><th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($products as $p)
        <tr>
          <td><strong>{{ $p->product_name }}</strong></td>
          <td>{{ $p->category?->category_name }}</td>
          <td style="font-family:monospace">${{ number_format($p->price,2) }}</td>
          <td>
            @if($p->product_type === 'drink')
              <span style="color:var(--muted);font-size:11px">Made-to-order</span>
            @elseif($p->qty <= 0)
              <span class="badge badge-danger">Out of Stock</span>
            @elseif($p->qty <= 10)
              <span class="badge badge-warning">Low ({{ $p->qty }})</span>
            @else
              <span class="badge badge-success">{{ $p->qty }}</span>
            @endif
          </td>
          <td><span class="badge badge-info">{{ $p->product_type }}</span></td>
          <td>
            <span class="badge {{ $p->status==='active'?'badge-success':'badge-danger' }}">
              {{ $p->status }}
            </span>
          </td>
          <td>
            <a href="{{ route('products.edit', $p) }}" class="btn btn-ghost btn-sm">Edit</a>
            <form method="POST" action="{{ route('products.destroy', $p) }}" style="display:inline">
              @csrf @method('DELETE')
              <button class="btn btn-danger btn-sm" onclick="return confirm('Deactivate this product?')">Off</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="pagination">{{ $products->links() }}</div>
</div>
@endsection