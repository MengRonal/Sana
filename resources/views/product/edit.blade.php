@extends('layout.admin')

@section('content')

<div class="container">

<form action="{{ route('product.update',$product->product_id) }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
@method('PUT')

<input type="text"
       name="product_name"
       value="{{ $product->product_name }}"
       class="form-control mb-2">

<input type="number"
       name="price"
       value="{{ $product->price }}"
       class="form-control mb-2">

<input type="number"
       name="qty"
       value="{{ $product->qty }}"
       class="form-control mb-2">

<input type="file"
       name="image"
       class="form-control mb-2">

<textarea name="description"
          class="form-control mb-2">{{ $product->description }}</textarea>

<button class="btn btn-primary">
    Update Product
</button>

</form>

</div>

@endsection