@extends('auth.auth')
@section('content')
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="/"><img style="width: 300px; height: 100%" src="/assets/images/logo/wecare.png"
                            alt="Logo"></a>
                </div>
                <h1 class="auth-title">Reset Password</h1>
                @if (session()->has('message'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="/reset-password" data-parsley-validate>
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input disabled type="email" name="emailshow" class="form-control form-control"
                            value="{{ $email }}">
                        <input type="hidden" name="email" value="{{ $email }}">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input required type="password" name="password" class="form-control form-control" id="password"
                            placeholder="Password" data-parsley-minlength="8"
                            data-parsley-error-message="Kata sandi harus lebih besar dari atau sama dengan 8.">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input required type="password" name="password_confirm" class="form-control form-control"
                            placeholder="Confirm Password" data-parsley-equalto="#password"
                            data-parsley-error-message="Kata sandi tidak cocok.">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block shadow-lg mt-3">Kirim</button>
                </form>
                <div class="text-center mt-3">
                    <p class='text-gray-600'>Ingat akun Anda? <a href="/login" class="font-bold">Masuk</a>.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-lg-7 d-none d-lg-block">
            <div id="auth-right">
                <img src="/assets/images/bg/clarity-login.png" style="background-size: cover; height: 100%"
                    alt="clarity login">
            </div>
        </div>
    </div>
@endsection
