@extends('website.component.master')
@section('web_title', 'Login')
@section('content')
<ul class="nav auth-tabs mb-4">
    <li class="nav-item" role="presentation">
        <a href="{{ url('/web/register') }}" class="nav-link active">Register</a>
    </li>

</ul>
<div class="tab-pane fade show active" id="login-panel" role="tabpanel">
    <div class="text-center mb-4">
        <h4 class="fw-bold text-dark mb-1">Welcome Back</h4>
        <p class="text-muted small">Enter your details to access your account</p>
    </div>

    <form action="{{ route('login') }}" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label small fw-semibold text-dark">Phone Number</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input type="text" class="form-control form-control-with-icon" value="{{ old('phone') }}" name="phone" placeholder="" required>
            </div>
        </div>

        
        <button type="submit" class="btn btn-green w-100 rounded-3 mb-3">Sign In</button>
    </form>

    <div class="position-relative text-center my-4">
        <hr class="text-muted opacity-25">
        <span class="position-absolute top-50 start-50 translate-middle bg-white px-2 small text-muted"></span>
    </div>
</div>
@endsection