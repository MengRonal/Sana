@extends('layout.admin')

@section('content')

<h2>Create Delivery</h2>

<form action="{{ route('delivery.store') }}" method="POST">

@csrf

<input type="number" name="order_id" class="form-control mb-2" placeholder="Order ID">

<input type="text" name="driver_name" class="form-control mb-2" placeholder="Driver Name">

<input type="text" name="phone" class="form-control mb-2" placeholder="Phone">

<input type="text" name="address" class="form-control mb-2" placeholder="Address">

<select name="status" class="form-control mb-2">
    <option value="Pending">Pending</option>
    <option value="Shipping">Shipping</option>
    <option value="Delivered">Delivered</option>
</select>

<button class="btn btn-success">Save</button>

</form>

@endsection