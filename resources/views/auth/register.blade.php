@extends('auth.auth')
@section('content')
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo" style="margin-bottom:10px; text-align:left;">
                    <a href="/"><img style="width: 300px; height: auto;" src="/assets/images/logo/wecare.png"
                            alt="Logo"></a>
                </div><br>
                <h1 class="auth-title" style="margin-top:0; margin-bottom:8px; text-align:center;">Register</h1>
                <p class="auth-subtitle mb-3" style="margin-top:0; text-align:center;">
                    Setiap kebaikan Anda akan mengubah hidup mereka. Daftar sekarang dan mulai berbagi.
                </p>
                @if (session()->has('salah'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        {{ session('salah') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="/register" data-parsley-validate>
                    @csrf
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input required type="text" name="name" class="form-control form-control" placeholder="Nama">
                        <div class="form-control-icon">
                            <i class="bi bi-person"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input required type="email" name="email" class="form-control form-control" placeholder="Email"
                            data-parsley-type="email" data-parsley-error-message="Masukkan format email yang valid.">
                        <div class="form-control-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                    </div>
                    <div class="form-group position-relative has-icon-left mb-3">
                        <input type="tel" name="phone_number" class="form-control form-control"
                            placeholder="Nomor Telepon" data-parsley-type="number"
                            data-parsley-error-message="Masukkan format nomor telepon yang valid.">
                        <div class="form-control-icon">
                            <i class="bi bi-telephone"></i>
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
                            placeholder="Konfirmasi Password" data-parsley-equalto="#password"
                            data-parsley-error-message="Kata sandi tidak cocok.">
                        <div class="form-control-icon">
                            <i class="bi bi-shield-lock"></i>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block shadow-lg mt-3">Daftar</button>
                    <hr>
                </form>
                <div class="text-center mt-3">
                    <p class='text-gray-600'>Sudah memiliki akun? <a href="/login" class="font-bold">Masuk</a>.</p>
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
