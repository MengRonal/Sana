@extends('layout.admin')

@section('content')
<div class="container" style="margin-top: 20px; max-width: 600px;">
    <h2>កែប្រែ Offer</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('offer.update', $offer->offer_id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group" style="margin-bottom: 15px;">
            <label>ជ្រើសរើសផលិតផល:</label>
            <select name="product_id" class="form-control" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ $offer->product_id == $product->id ? 'selected' : '' }}>
                        {{ $product->product_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>ការបញ្ចុះតម្លៃ (%):</label>
            <input type="number" name="discount" class="form-control" value="{{ $offer->discount }}" min="1" max="100" required>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>តម្លៃថ្មី ($):</label>
            <input type="number" name="new_price" step="0.01" class="form-control" value="{{ $offer->new_price }}" required>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>ថ្ងៃចាប់ផ្តើម:</label>
            <input type="date" name="start_date" class="form-control" value="{{ $offer->start_date }}" required>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>ថ្ងៃបញ្ចប់:</label>
            <input type="date" name="end_date" class="form-control" value="{{ $offer->end_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">ធ្វើបច្ចុប្បន្នភាព</button>
        <a href="{{ route('offer.list') }}" class="btn btn-secondary">ត្រឡប់ក្រោយ</a>
    </form>
</div>
@endsection
