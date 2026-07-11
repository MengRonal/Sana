@extends('layout.admin')

@section('content')

<div class="container">

<h2>Stock Logs</h2>

<a href="{{ route('stock_logs.create') }}" class="btn btn-primary mb-3">
Add Stock Log
</a>

<table class="table table-bordered">

<tr>
    <th>ID</th>
    <th>Product</th>
    <th>Type</th>
    <th>Quantity</th>
    <th>Note</th>
    <th>Action</th>
</tr>

@foreach($stock_logs as $stock)

<tr>

<td>{{ $stock->id }}</td>

<td>{{ $stock->product_id }}</td>

<td>{{ $stock->type }}</td>

<td>{{ $stock->quantity }}</td>

<td>{{ $stock->note }}</td>

<td>

<a href="{{ route('stock_logs.edit',$stock->id) }}" class="btn btn-warning btn-sm">
Edit
</a>
<form action="{{ route('stock_logs.destroy',$stock->id) }}"
      method="POST"
      style="display:inline-block;">
@csrf
@method('DELETE')

<button class="btn btn-danger btn-sm">
Delete
</button>

</form>

</td>

</tr>

@endforeach

</table>

</div>

@endsection