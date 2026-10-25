@extends('layout.admin')
@section('content')
@if ($errors->any())
<div style="color: red;">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="d-flex justify-content-center align-items-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Add Offer</div>
                <hr>
                <form action="{{ route('offer.store') }}" method="POST">
                    @csrf

                    <div class="form-group" style="margin-bottom: 15px;">
    <label>ជ្រើសរើសផលិតផល:</label>

    <select name="product_id" class="form-control" required>
        <option value="">-- ជ្រើសរើសផលិតផល --</option>

        @foreach($products as $product)
            <option value="{{ $product->product_id }}">
                {{ $product->product_name }}
            </option>
        @endforeach
    </select>
</div>
                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>ការបញ្ចុះតម្លៃ (%):</label>
                        <input type="number" name="discount" class="form-control" min="1" max="100" placeholder="ឧទាហរណ៍៖ 20" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>តម្លៃថ្មី ($):</label>
                        <input type="number" name="new_price" step="0.01" class="form-control" placeholder="ឧទាហរណ៍៖ 15.50" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>ថ្ងៃចាប់ផ្តើម:</label>
                        <input type="date" name="start_date" class="form-control" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 15px;">
                        <label>ថ្ងៃបញ្ចប់:</label>
                        <input type="date" name="end_date" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">រក្សាទុក</button>
                    <a href="{{ route('offer.list') }}" class="btn btn-secondary">ត្រឡប់ក្រោយ</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection