@extends('layout.admin') {{-- ប្រើ Layout របស់ Admin របស់អ្នក --}}

@section('content')
<div class="container" style="margin-top: 20px;">
    <h2>Offer List</h2>
    <a href="{{ route('offer.create') }}" class="btn btn-primary" style="margin-bottom: 15px;">+ New Offer</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Discount (%)</th>
                <th>New Price</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($offers as $offer)
            <tr>
                <td>{{ $offer->offer_id }}</td>
                {{-- ប្តូរ product_name ទៅតាមឈ្មោះ column ក្នុងតារាង product របស់អ្នក --}}
                <td>{{ $offer->product->product_name ?? 'No Product' }}</td> 
                <td>{{ $offer->discount }}%</td>
                <td>${{ number_format($offer->new_price, 2) }}</td>
                <td>{{ $offer->start_date }}</td>
                <td>{{ $offer->end_date }}</td>
                <td>
                    <a href="{{ route('offer.edit', $offer->offer_id) }}" class="btn btn-warning btn-sm">Edit</a>
                    
                    <form action="{{ route('offer.destroy', $offer->offer_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this offer?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No offers</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $offers->links() }}
    </div>
</div>
@endsection
