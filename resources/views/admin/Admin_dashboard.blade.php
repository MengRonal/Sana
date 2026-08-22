@extends('layout.admin')

@section('content')
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11">
    @if (Session::has('success_login'))
    <div class="toast js-auto-toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <strong>Success:</strong> {{ session('success_login') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>

    @elseif(Session::has('error'))
    <div class="toast js-auto-toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <strong>Error:</strong> {{ session('error') }}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
    @endif
</div>
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="d-flex">
                            <div class="wrapper">
                               <h3 class="mb-0 font-weight-semibold">{{ $t_User }}</h3>
                                <h5 class="mb-0 font-weight-medium text-primary">Users</h5>
                            </div>
                            
                        </div>
                    </div>
                    {{-- <div class="col-lg-3 col-md-6">
                        <div class="d-flex">
                            <div class="wrapper">
                               <h3 class="mb-0 font-weight-semibold">{{ $t_cusomter }}</h3>
                                <h5 class="mb-0 font-weight-medium text-primary">Customers</h5>
                            </div>
                            
                        </div>
                    </div> --}}
                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
                            <div class="wrapper">
                                <h3 class="mb-0 font-weight-semibold">0000</h3>
                                <h5 class="mb-0 font-weight-medium text-primary">Revenue Today</h5>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
                            <div class="wrapper">
                                <h3 class="mb-0 font-weight-semibold">0000</h3>
                                <h5 class="mb-0 font-weight-medium text-primary">Order Today</h5>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mt-md-0 mt-4">
                        <div class="d-flex">
                            <div class="wrapper">
                                <h3 class="mb-0 font-weight-semibold">0000</h3>
                                <h5 class="mb-0 font-weight-medium text-primary">Inventories</h5>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row g-4 mt-2">
    <div class="col-12 col-lg-7">
        <div class="card border-0 shadow-sm p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold m-0 text-dark">Peak Sales Hours</h5>
                <span class="badge bg-light text-secondary">Today</span>
            </div>
            <div style="height: 280px; position: relative;">
                <canvas id="peakSalesChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Right Column: Live POS Ticker -->
    <div class="col-12 col-lg-5">
        <div class="card border-0 shadow-sm p-4 h-100">
            <h5 class="fw-bold mb-3 text-dark">Live POS Stream</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light fs-7 text-uppercase">
                        <tr>
                            <th>Item</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="fs-7">
                        <tr>
                            <td><strong>1x Iced Caramel Latte</strong></td>
                            <td><span class="badge bg-info-subtle text-info">Takeaway</span></td>
                            <td><span class="spinner-grow spinner-grow-sm text-warning" role="status"></span> Brewing
                            </td>
                        </tr>
                        <tr>
                            <td><strong>2x Espresso, 1x Croissant</strong></td>
                            <td><span class="badge bg-purple-subtle text-purple">Table 4</span></td>
                            <td><span class="badge bg-success-subtle text-success">Completed</span></td>
                        </tr>
                        <tr>
                            <td><strong>1x Matcha Latte (Oat)</strong></td>
                            <td><span class="badge bg-info-subtle text-info">App Order</span></td>
                            <td><span class="badge bg-success-subtle text-success">Completed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection