
@extends('layout.admin')

@section('content')
<div class="container py-4">

    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body">

                    <h4 class="card-title">Edit Offer</h4>
                    <p class="card-description">
                        Update your product offer information below.
                    </p>

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Please fix the following errors:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Edit Offer Form --}}
                    <form action="{{ route('offer.update', $offer->offer_id) }}"
                          method="POST"
                          class="forms-sample">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="product_id">Product Name</label>
                            <select name="product_id"
                                    id="product_id"
                                    class="form-control"
                                    required>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}"
                                        {{ old('product_id', $offer->product_id) == $product->id ? 'selected' : '' }}>
                                        {{ $product->product_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="discount">Discount (%)</label>
                            <input type="number"
                                   name="discount"
                                   id="discount"
                                   class="form-control"
                                   placeholder="Enter discount percentage"
                                   value="{{ old('discount', $offer->discount) }}"
                                   min="1"
                                   max="100"
                                   step="0.01"
                                   required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="new_price">New Price ($)</label>
                            <input type="number"
                                   name="new_price"
                                   id="new_price"
                                   class="form-control"
                                   placeholder="Enter new price"
                                   value="{{ old('new_price', $offer->new_price) }}"
                                   min="0"
                                   step="0.01"
                                   required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="start_date">Start Date</label>
                            <input type="date"
                                   name="start_date"
                                   id="start_date"
                                   class="form-control"
                                   value="{{ old('start_date', $offer->start_date ? \Carbon\Carbon::parse($offer->start_date)->format('Y-m-d') : '') }}"
                                   required>
                        </div>

                        <div class="form-group mb-4">
                            <label for="end_date">End Date</label>
                            <input type="date"
                                   name="end_date"
                                   id="end_date"
                                   class="form-control"
                                   value="{{ old('end_date', $offer->end_date ? \Carbon\Carbon::parse($offer->end_date)->format('Y-m-d') : '') }}"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-success mr-2">
                            Update Offer
                        </button>

                        <a href="{{ route('offer.list') }}"
                           class="btn btn-light">
                            Cancel
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
