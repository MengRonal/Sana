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
        font-size: 14px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background .15s ease;
    }
    .btn-add-category:hover {
        background: #1d4ed8;
        color: #fff;
    }

    .cat-card {
        background: #fff;
        border-radius: 14px;
        border: none;
        box-shadow: 0 1px 3px rgba(0,0,0,.06);
        padding: 24px;
    }

    .cat-table {
        width: 100%;
        border-collapse: collapse;
    }
    .cat-table thead th {
        text-align: left;
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: .03em;
        padding: 10px 12px;
        border-bottom: 1px solid #e5e7eb;
        background: transparent;
    }
    .cat-table tbody td {
        padding: 14px 12px;
        font-size: 14px;
        color: #111827;
        border-bottom: 1px solid #f1f2f4;
        vertical-align: middle;
    }
    .cat-table tbody tr:hover {
        background: #f9fafb;
    }

    .btn-edit-sm {
        background: #f59e0b;
        border: none;
        color: #fff;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12.5px;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
    }
    .btn-edit-sm:hover { background: #d97706; color: #fff; }

    .btn-delete-sm {
        background: #ef4444;
        border: none;
        color: #fff;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 12.5px;
        font-weight: 500;
    }
    .btn-delete-sm:hover { background: #dc2626; }

    .class-pagination nav p { display: none !important; }
    .class-pagination {
        display: flex;
        justify-content: flex-end;
        margin-top: 18px;
    }
    .class-pagination .pagination {
        gap: 4px;
    }
    .class-pagination .page-link {
        border-radius: 8px !important;
        border: 1px solid #e5e7eb;
        color: #374151;
        font-size: 13px;
        min-width: 32px;
        text-align: center;
    }
    .class-pagination .page-item.active .page-link {
        background: #2563eb;
        border-color: #2563eb;
        color: #fff;
    }
</style>

<div class="cat-page-bg">

    <div class="cat-topbar">
        <h4 class="cat-page-title">Category List</h4>

        <a href="{{ route('categories.create') }}" class="btn-add-category">
            <i class="fa fa-plus"></i> Add New Category
        </a>
    </div>

    <div class="cat-card">
        <div class="table-responsive">
            <table class="cat-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th style="width:180px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $row)
                        <tr>
                            <td>{{ $row->category_id }}</td>
                            <td>{{ $row->category_name }}</td>
                            <td>{{ $row->description }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $row->category_id) }}" class="btn-edit-sm">
                                    Edit
                                </a>

                                <form action="{{ route('categories.destroy', $row->category_id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn-delete-sm btn-delete">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="class-pagination">
            {{ $categories->links('pagination::simple-bootstrap-5') }}
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // 1. សម្រាប់បង្ហាញការជូនដំណឹង (Create / Edit / Delete ជោគជ័យ) រក្សាទុក 3 វិនាទី
        @if(session('success'))
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'success',
                title: "{{ session('success') }}"
            });
        @endif

        // 2. សម្រាប់បង្ហាញផ្ទាំងសួរមុននឹងលុប (SweetAlert2 Confirm Dialog)
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const form = this.closest('.delete-form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // បញ្ជូន Form ទៅលុបក្នុង Database បើចុច Yes
                    }
                });
            });
        });
    });
</script>

@endsection