@extends('layout.admin')

@section('content')

<div class="container-fluid">

    <div class="card shadow">
        <div class="card-header">
            <h3>Add Setting</h3>
        </div>

        <div class="card-body">

            <form action="{{ route('setting.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Shop Name</label>
                        <input type="text" name="shop_name" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Telephone</label>
                        <input type="text" name="tel" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Exchange Rate</label>
                        <input type="number" step="0.01" name="exchange_rate" class="form-control" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label>Logo</label>
                        <input type="file" name="logo" class="form-control">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Address</label>
                        <textarea name="address" rows="4" class="form-control"></textarea>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">
                    Save
                </button>

                <a href="{{ route('setting.list') }}" class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>
    </div>

</div>

@endsection