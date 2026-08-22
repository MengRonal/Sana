@extends('login_resig.main')
@section('page_title', 'Login')
@section('content')
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 11">
    @if (Session::has('success'))
    <div class="toast js-auto-toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <strong>Success:</strong> {{ session('success') }}
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
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    <div class="auto-form-wrapper">
                        <h3 class="fw-bold text-dark mb-1">Welcome Back</h3>
                        <p class="text-muted small">Enter your details to access your account</p>
                        <form action="{{ route('process_login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label class="label">Username</label>
                                <div class="input-group">
                                    <input value="{{ old('name') }}" type="text" name="name" class="form-control"
                                        placeholder="Username">

                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-check-circle-outline"></i>
                                        </span>
                                    </div>

                                </div>
                                @error('name')
                                <small style="color: #c61b2c;">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="label">Password</label>
                                <div class="input-group">
                                    <input type="password" value="{{ old('password') }}" name="password" class="form-control" id="password-input"
                                        placeholder="Min. 6 Characters">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="toggle-password" style="cursor: pointer;">
                                            <i class="mdi mdi-eye-outline" id="toggle-icon"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('password')
                                <small style="color: #721c24;">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary submit-btn btn-block">Login</button>
                            </div>
                            <div class="text-block text-center my-3">
                                <a href="{{ route('showRegister') }}" class="text-black text-small">Create new
                                    account</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
