
@extends('layout.pos')

@section('content')
<style>
    .pos-workspace {
    grid-template-columns: 1fr !important;
    }
    
    .customer-card {
    background: #ffffff;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
    border: 1px solid #eaeaea;
    }
    .customer-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
        border: 1px solid #eaeaea;
    }

    .table-custom th {
        background-color: #f8f9fa !important;
        color: #6c757d;
        font-weight: 600;
        font-size: 12px;
        border-bottom: 1px solid #edf2f7;
        padding-top: 12px;
        padding-bottom: 12px;
    }

    .table-custom td {
        font-size: 13px;
        vertical-align: middle;
        padding-top: 12px;
        padding-bottom: 12px;
    }

    .avatar-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #e6f4f0;
        color: #0d9468;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
    }

    .badge-pos {
        background-color: #e6f4f0;
        color: #0d9468;
        font-weight: 600;
        padding: 5px 10px;
        border-radius: 6px;
    }
</style>

<div class="container-fluid px-4 py-3">
    <!-- Header Row -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold m-0 text-dark"><i class="fa-solid fa-users text-success me-2"></i>Customer Management
            </h4>
            <small class="text-muted">Manage POS customer profiles and history</small>
        </div>
        <button class="btn btn-success fw-semibold px-3 py-2"
            style="background-color: #0d9468; border: none; font-size: 13px;" data-bs-toggle="modal"
            data-bs-target="#addCustomerModal">
            <i class="fa-solid fa-user-plus me-1"></i> Add New Customer
        </button>
    </div>

    <!-- Quick Stats & Search Row -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-md-4">
            <div class="customer-card d-flex align-items-center justify-content-between py-3">
                <div>
                    <span class="text-muted d-block" style="font-size: 12px;">Total Customers</span>
                    <h3 class="fw-bold m-0 text-dark">{{ $totalCustomers }}</h3>
                </div>
                <div class="avatar-circle fs-5">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-md-8">
            <div class="customer-card py-3 px-3 d-flex align-items-center h-100">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0 ps-3"><i
                            class="fa-solid fa-magnifying-glass text-muted"></i></span>
                    <input type="text" class="form-control bg-light border-0 py-2" id="searchCustomer"
                        placeholder="Search customer by name, phone, or email...">
                </div>
            </div>
        </div>
    </div>

    <!-- Main Table Panel -->
    <div class="customer-card p-0 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover table-custom m-0 align-middle">
                <thead>
                    <tr>
                        <th class="ps-4" style="width: 25%;">Customer</th>
                        <th style="width: 20%;">Email</th>
                        <th style="width: 15%;">Phone</th>
                        <th style="width: 20%;">Address</th>
                        <th style="width: 10%;">Created By</th>
                        <th class="text-end pe-4" style="width: 10%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="avatar-circle">
                                    {{ strtoupper(substr($customer->name ?? 'C', 0, 1)) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark">{{ $customer->name ?? 'N/A' }}</div>
                                    <small class="text-muted" style="font-size: 11px;">ID: #{{ $customer->customer_id
                                        }}</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-secondary">{{ $customer->email ?? 'N/A' }}</td>
                        <td>
                            <span class="badge-pos">{{ $customer->phone ?? 'N/A' }}</span>
                        </td>
                        <td class="text-secondary">{{ Str::limit($customer->address ?? 'No address set', 25) }}</td>
                        <td>
                            <span class="text-secondary fw-semibold">
                                <i class="fa-regular fa-user me-1"></i>{{ $customer->user->name ?? 'System' }}
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-light text-success fw-semibold me-1 px-2 py-1"
                                title="Select for POS Order">
                                <i class="fa-solid fa-check"></i> Select
                            </button>
                            <button class="btn btn-sm btn-light text-secondary px-2 py-1" title="Edit Profile">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-user-slash fs-2 d-block mb-2 text-black-50"></i>
                            No customers found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Bar -->
        @if($customers->hasPages())
        <div class="d-flex justify-content-between align-items-center p-3 border-top bg-light bg-opacity-10">
            <small class="text-muted">
                Showing {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }}
                results
            </small>
            <div>
                {{ $customers->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-bottom">
                <h6 class="modal-title fw-bold"><i class="fa-solid fa-user-plus text-success me-2"></i>Add New Customer
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="#" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label text-muted fw-semibold" style="font-size:12px;">Full Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="John Doe">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold" style="font-size:12px;">Phone
                                Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="+123456789">
                        </div>
                        <div class="col-6">
                            <label class="form-label text-muted fw-semibold" style="font-size:12px;">Email
                                Address</label>
                            <input type="email" name="email" class="form-control" placeholder="john@example.com">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-muted fw-semibold" style="font-size:12px;">Address</label>
                        <textarea name="address" class="form-control" rows="2"
                            placeholder="Customer address..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top bg-light">
                    <button type="button" class="btn btn-light btn-sm px-3" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success btn-sm px-4" style="background-color: #0d9468;">Save
                        Customer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection