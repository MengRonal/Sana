@extends('layout.admin')

@section('content')

<h2>Edit Delivery</h2>

<form action="{{ route('delivery.update',$delivery->id) }}" method="POST">

@csrf
@method('PUT')

<input type="number" name="order_id" class="form-control mb-2" value="{{ $delivery->order_id }}">

<input type="text" name="driver_name" class="form-control mb-2" value="{{ $delivery->driver_name }}">

<input type="text" name="phone" class="form-control mb-2" value="{{ $delivery->phone }}">

<input type="text" name="address" class="form-control mb-2" value="{{ $delivery->address }}">

<select name="status" class="form-control mb-2">
    <option value="Pending" {{ $delivery->status=='Pending'?'selected':'' }}>Pending</option>
    <option value="Shipping" {{ $delivery->status=='Shipping'?'selected':'' }}>Shipping</option>
    <option value="Delivered" {{ $delivery->status=='Delivered'?'selected':'' }}>Delivered</option>
</select>

<button class="btn btn-primary">Update</button>

</form>

@endsection