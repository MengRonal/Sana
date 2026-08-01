@extends('layout.admin')

@section('content')

<div class="container">

<h2>Delivery</h2>

<a href="{{ route('delivery.create') }}" class="btn btn-primary mb-3">
Add Delivery
</a>

<table class="table table-bordered">

<tr>
    <th>ID</th>
    <th>Order</th>
    <th>Driver</th>
    <th>Phone</th>
    <th>Status</th>
    <th>Action</th>
</tr>

@foreach($deliveries as $delivery)

<tr>

<td>{{ $delivery->id }}</td>

<td>{{ $delivery->order_id }}</td>

<td>{{ $delivery->driver_name }}</td>

<td>{{ $delivery->phone }}</td>

<td>{{ $delivery->status }}</td>

<td>

<a href="{{ route('delivery.show',$delivery->id) }}" class="btn btn-info btn-sm">View</a>

<a href="{{ route('delivery.edit',$delivery->id) }}" class="btn btn-warning btn-sm">Edit</a>

<form action="{{ route('delivery.destroy',$delivery->id) }}" method="POST" style="display:inline">

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