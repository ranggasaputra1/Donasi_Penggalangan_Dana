@extends('auth.auth')
@section('content')
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo" style="margin-bottom:10px; text-align:left;">
                    <a href="/"><img style="width: 300px; height: auto;" src="/assets/images/logo/wecare.png"
                            alt="Logo"></a>
                </div><br>
                <h1 class="auth-title" style="margin-top:0; margin-bottom:8px; text-align:center;">Login</h1>
                <p class="auth-subtitle mb-3" style="margin-top:0; text-align:center;">
                    Selamat datang kembali. Akses akun Anda dan lanjutkan kebaikan yang telah Anda mulai.
                </p>
                @isset($registrasi)
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Akun berhasil dibuat silahkan login
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endisset
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible show fade" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (session()->has('salah'))
                    <div class="alert alert-danger alert-dismissible show fade" role="alert">
                        {{ session('salah') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="/login" data-parsley-validate>
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input type="email" name="email" class="form-control form-control" placeholder="Email"
                            data-parsley-type="email" data-parsley-error-message="Masukkan format email yang valid.">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input type="password" name="password" class="form-control form-control" placeholder="Password"
                            data-parsley-minlength="8"
                            data-parsley-error-message="Kata sandi harus lebih besar dari atau sama dengan 8.">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block shadow-lg mt-3">Masuk</button>
                    <hr>
                </form>
                <div class="text-center mt-3">
                    <p class="text-gray-600">Belum memiliki akun? <a href="/register" class="font-bold">Daftar</a>.</p>
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
