@extends('layout.admin')

@section('content')

<h2>Edit Stock Log</h2>

<form action="{{ route('stock_logs.update',$stock_log->id) }}" method="POST">

@csrf
@method('PUT')

<input type="number" name="product_id" class="form-control mb-2" value="{{ $stock_log->product_id }}">

<select name="type" class="form-control mb-2">
    <option value="IN" {{ $stock_log->type=='IN'?'selected':'' }}>IN</option>
    <option value="OUT" {{ $stock_log->type=='OUT'?'selected':'' }}>OUT</option>
</select>

<input type="number" name="quantity" class="form-control mb-2" value="{{ $stock_log->quantity }}">

<input type="text" name="note" class="form-control mb-2" value="{{ $stock_log->note }}">

<button class="btn btn-primary">Update</button>

</form>

@endsection