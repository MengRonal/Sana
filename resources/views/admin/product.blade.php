@extends('layout.admin')

@section('content')

<style>
    .cat-page-bg {
        background: #f3f4f6;
        min-height: 100vh;
        padding: 24px;
    }

    .cat-topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        gap: 16px;
        flex-wrap: wrap;
    }

    .cat-page-title {
        font-size: 20px;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    .btn-add-category {
        background: #2563eb;
        border: none;
        color: #fff;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
    }

    .btn-add-category:hover {
        background: #1d4ed8;
        color: #fff;
    }

    .cat-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(0,0,0,.06);
        padding: 24px;
    }

    .cat-table {
        width: 100%;
        border-collapse: collapse;
    }

    .cat-table th {
        padding: 12px;
        font-size: 13px;
        text-transform: uppercase;
        color: #6b7280;
        border-bottom: 1px solid #e5e7eb;
    }

    .cat-table td {
        padding: 12px;
        border-bottom: 1px solid #f1f2f4;
        vertical-align: middle;
    }

    .cat-table tbody tr:hover {
        background: #f9fafb;
    }

    .product-image{
        width:60px;
        height:60px;
        border-radius:8px;
        object-fit:cover;
        border:1px solid #ddd;
    }

    .badge-active{
        background:#22c55e;
        color:white;
        padding:5px 10px;
        border-radius:20px;
    }

    .badge-inactive{
        background:#ef4444;
        color:white;
        padding:5px 10px;
        border-radius:20px;
    }

    .btn-edit-sm{
        background:#f59e0b;
        color:#fff;
        padding:6px 12px;
        border-radius:6px;
        text-decoration:none;
        border:none;
    }

    .btn-delete-sm{
        background:#ef4444;
        color:#fff;
        padding:6px 12px;
        border:none;
        border-radius:6px;
    }

    .btn-edit-sm:hover{
        background:#d97706;
        color:white;
    }

    .btn-delete-sm:hover{
        background:#dc2626;
    }

</style>

<div class="cat-page-bg">

    <div class="cat-topbar">

        <h4 class="cat-page-title">
            Product List
        </h4>

        <a href="{{ route('product.create') }}" class="btn-add-category">
            <i class="fa fa-plus"></i>
            Add New Product
        </a>

    </div>

    <div class="cat-card">

        <div class="table-responsive">

            <table class="cat-table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($products as $product)

                    <tr>
                        <td>{{ $product->product_id }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/'.$product->image) }}"
                                     class="product-image">
                            @else
                                <img src="https://via.placeholder.com/60"
                                     class="product-image">
                            @endif
                        </td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->category->category_name ?? '-' }}</td>
                        <td>{{ $product->supplier->supplier_name ?? '-' }}</td>
                        <td>$ {{ number_format($product->price,2) }}</td>
                        <td>{{ $product->qty }}</td>
                        <td>{{ $product->product_type }}</td>

                        <td>

                            @if($product->status=="Active")

                                <span class="badge-active">
                                    Active
                                </span>

                            @else

                                <span class="badge-inactive">
                                    Inactive
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('products.edit',$product->product_id) }}"
                               class="btn-edit-sm">
                                Edit
                            </a>

                            <form action="{{ route('products.destroy',$product->product_id) }}"
                                  method="POST"
                                  class="d-inline delete-form">

                                @csrf
                                @method('DELETE')

                                <button type="button"
                                        class="btn-delete-sm btn-delete">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="10" class="text-center">
                            No Product Found
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="mt-3">
            {{ $products->links('pagination::simple-bootstrap-5') }}
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

@if(session('success'))

Swal.fire({
    icon:'success',
    title:'Success',
    text:"{{ session('success') }}",
    timer:2000,
    showConfirmButton:false
});

@endif

document.querySelectorAll('.btn-delete').forEach(btn=>{

    btn.addEventListener('click',function(){

        let form=this.closest('form');

        Swal.fire({

            title:'Delete Product?',
            text:'You will not be able to recover this data.',

            icon:'warning',

            showCancelButton:true,

            confirmButtonText:'Yes, Delete',

            cancelButtonText:'Cancel'

        }).then((result)=>{

            if(result.isConfirmed){

                form.submit();

            }

        });

    });

});

</script>

@endsection