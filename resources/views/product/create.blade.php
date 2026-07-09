@extends('layout.admin')

@section('content')

<div class="container">

<form action="{{ route('product.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf

<input type="text"
       name="product_name"
       class="form-control mb-2"
       placeholder="Product Name">

<input type="number"
       name="price"
       class="form-control mb-2"
       placeholder="Price">

<input type="number"
       name="qty"
       class="form-control mb-2"
       placeholder="Quantity">

<input type="file"
       name="image"
       class="form-control mb-2">

<textarea name="description"
          class="form-control mb-2">
</textarea>

<button class="btn btn-success">
    Save Product
</button>

</form>

</div>

@endsection