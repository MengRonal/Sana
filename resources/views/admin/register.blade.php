@extends('login_resig.main')
@section('page_title', 'Register')
@section('content')
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
            <div class="row w-100">
                <div class="col-lg-4 mx-auto">
                    
                    <div class="auto-form-wrapper">
                        <h2 class="fw-bold text-dark mb-1">Create Account</h2>
                        <p class="text-muted small">Join us to earn points and enjoy fast checkout</p>
                        <form action="{{ route('process_Register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Username</label>
                                <div class="input-group">
                                    <input type="text" value="{{ old('name') }}" name="name" class="form-control"
                                    placeholder="Username">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-check-circle-outline"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <div class="input-group">
                                    <input value="{{ old('password') }}" type="password" name="password" class="form-control" placeholder="Min. 6 Characters"
                                    id="password-input">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="toggle-password" style="cursor: pointer;">
                                            <i class="mdi mdi-eye-outline" id="toggle-icon"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="">Comnfirm Password</label>
                                <div class="input-group">
                                    <input value="{{ old('password') }}" name="con_pass" type="password" class="form-control"
                                        placeholder="Min. 6 Characters" id="confirm-input">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="toggle-confirm" style="cursor: pointer;">
                                            <i class="mdi mdi-eye-outline" id="toggle-confirm-icon"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary submit-btn btn-block">Register</button>
                            </div>
                            <div class="text-block text-center my-3">
                                <span class="text-small font-weight-semibold">Already have and account ?</span>
                                <a href="{{ route('showlogin') }}" class="text-black text-small">Login</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection