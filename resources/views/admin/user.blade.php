@extends('layout.admin')
@section('content')
<div class="mb-3 d-flex justify-content-between align-items-center">
    <a href="{{ route('auth.create') }}" class="btn btn-primary btn-sm ">New User</a>
  <div class="d-flex justify-content-between align-items-center">
    <form class="d-none d-md-flex ms-4">
        <input class="form-control" type="search" name="search" value="{{ Request::get('search') }}"
            placeholder="Search here...">
        <button type="submit" class="btn btn-primary btn-sm ml-1">Search</button>
    </form>
    </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Users</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Username</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Thida</td>
                        <td>thida@gmailcom</td>
                        <td>1234567890</td>
                        <td>Thida_admin</td>
                        <td>Admin</td>
                        <td>
                            <label class="badge badge-primary">Active</label>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection