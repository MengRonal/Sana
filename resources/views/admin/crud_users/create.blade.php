@extends('layout.admin')
@section('content')
<div class="d-flex justify-content-center align-items-center">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="card-title">Add Users</div>
                <hr>
               <form id="fromCreateUser" action="{{ route('auth.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control form-control-rounded" id="name" name="name"
                            placeholder="Enter Your Name">
                        <p class="invalid-feedback m-0"></p>
                    </div>

                    <div class="form-group">
                        <label for="role_id">Choose Role</label>
                        <select id="role_id" name="role_id" class="form-control">
                            @foreach ($role as $r)
                            <option value="{{ $r->role_id }}">{{ $r->role_name }}</option>
                            @endforeach
                        </select>
                        <p class="invalid-feedback m-0"></p>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control form-control-rounded" id="phone" name="phone"
                            placeholder="Enter Your Mobile Number">
                        <p class="invalid-feedback m-0"></p>
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control form-control-rounded" id="username" name="username"
                            placeholder="Enter username">
                        <p class="invalid-feedback m-0"></p>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-rounded" id="email" name="email"
                            placeholder="Enter Your Email">
                        <p class="invalid-feedback m-0"></p>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control form-control-rounded" id="password" name="password"
                            placeholder="Enter Your Password">
                        <p class="invalid-feedback m-0"></p>
                    </div>

                    <div class="form-group py-2">
                        <div class="icheck-material-white">
                            <input type="checkbox" id="status" name="status" value="active" checked />
                            <label for="status">Status (Active)</label>
                        </div>
                        <p class="invalid-feedback m-0"></p>
                    </div>

                    <div class="form-group d-flex justify-content-between align-items-center">
                        <a href="{{ route('auth.list') }}" class="btn btn-sm btn-danger">Cancel</a>
                       <button type="submit" onclick="StoreUser('#fromCreateUser')" id="submituser" class="btn btn-primary btn-round px-5">
                            Create
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    const StoreUser = (form)=>{
        let payloads = new FormData($(form)[0]);
        $.ajax({
            type: "post",
            url: "{{ route('auth.store') }}", 
            data: payloads,
            dataType: "json",
            contentType:false,
            processData:false,
            success: function (response) {
                if(response.status == 200){
                    $(form).trigger('reset')
                    $('#input').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                    window.location.href = "{{ route('auth.list') }}"
                }else{
                    let error = response.errors;
                    if(error.name != null){
                        $('#name').addClass('is-invalid').siblings('p').addClass('text-danger').text(error.name);
                    }else{
                        $('#name').removeClass('is-invalid').siblings('p').removeClass('text-danger').text('');
                    }
                }
            }
        });
    }

    $('#fromCreateUser').on('submit', function(e) {
        e.preventDefault(); 
        StoreUser('#fromCreateUser'); 
    });
</script>
@endsection