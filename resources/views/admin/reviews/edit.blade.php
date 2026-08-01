@extends('layout.admin')

@section('content')

<h2>Edit Review</h2>

<form action="{{ route('reviews.update',$review->id) }}" method="POST">

@csrf
@method('PUT')

<input type="number" name="customer_id" class="form-control mb-2" value="{{ $review->customer_id }}">

<input type="number" name="product_id" class="form-control mb-2" value="{{ $review->product_id }}">

<select name="rating" class="form-control mb-2">
    @for($i=1;$i<=5;$i++)
        <option value="{{ $i }}" {{ $review->rating==$i?'selected':'' }}>
            {{ $i }} Star
        </option>
    @endfor
</select>

<textarea name="comment" class="form-control mb-2">{{ $review->comment }}</textarea>

<button class="btn btn-primary">Update</button>

</form>

@endsection