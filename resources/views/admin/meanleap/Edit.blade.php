@extends('layout.admin')

@section('content')

<div class="container">

<div class="card">

<div class="card-header">
<h3>Edit Setting</h3>
</div>

<div class="card-body">

<form action="{{ route('setting.update',$shop->id) }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="mb-3">
<label>Shop Name</label>
<input type="text"
class="form-control"
name="shop_name"
value="{{ $shop->shop_name }}">
</div>

<div class="mb-3">
<label>Telephone</label>
<input type="text"
class="form-control"
name="tel"
value="{{ $shop->tel }}">
</div>

<div class="mb-3">
<label>Exchange Rate</label>
<input type="text"
class="form-control"
name="exchange_rate"
value="{{ $shop->exchange_rate }}">
</div>

<div class="mb-3">
<label>Address</label>

<textarea
class="form-control"
name="address">{{ $shop->address }}</textarea>

</div>

<div class="mb-3">

@if($shop->logo)

<img src="{{ asset('uploads/'.$shop->logo) }}"
width="80"
class="mb-2">

@endif

<input type="file"
class="form-control"
name="logo">

</div>

<button class="btn btn-success">
Update
</button>

<a href="{{ route('setting.list') }}"
class="btn btn-secondary">
Cancel
</a>

</form>

</div>

</div>

</div>

@endsection