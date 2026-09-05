@extends('layout.admin')
@section('content')
<div class="mb-3 d-flex justify-content-between align-items-center">
    <a href="{{ route('supplier.create') }}" class="btn btn-primary btn-sm ">New Supplier</a>
    <div class="d-flex justify-content-between align-items-center">
        <form class="d-none d-md-flex ms-4">
            <input class="form-control" type="search" name="search" value="{{ Request::get('search') }}"
                placeholder="Search here...">
            <button type="submit" class="btn btn-primary btn-sm ml-1">Search</button>
        </form>
    </div>
</div>
@include("admin.message.message")
<div class="col-lg-12 grid-margin stretch-card">

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Suppliers</h2>
            <table class="table">
                <thead class="text-uppercase">
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($supp_key as $supp)
                    <tr>
                        <td>{{ $supp->supplier_id }}</td>
                        <td>{{ $supp->name }}</td>
                        <td>{{ $supp->email }}</td>
                        <td>{{ $supp->phone }}</td>
                        <td>{{ $supp->address }}</td>
                        
                        <td>
                           
                        
                        
                            <a href="{{ route('supplier.edit',$supp->supplier_id) }}" title="Edit"><i class="bi bi-pencil-square"></i></a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="d-flex justify-content-between mt-4">
                <div class="no-info-pagination">
                    {{ $supp_key->links() }}
                </div>

                <style>
                    .no-info-pagination .pagination+p,
                    .no-info-pagination p.text-muted {
                        display: none !important;
                    }
                </style>
                <div><a href="{{ route('supplier.list') }}" class="btn btn-sm btn-success">Refresh</a></div>
            </div>
        </div>
    </div>
</div>
@endsection