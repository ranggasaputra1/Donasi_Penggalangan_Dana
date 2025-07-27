@extends('auth.auth')
@section('content')
    <div class="row h-100">
        <div class="col-lg-5 col-12">
            <div id="auth-left">
                <div class="auth-logo">
                    <a href="/"><img style="width: 300px; height: 100%" src="/assets/images/logo/wecare.png"
                            alt="Logo"></a>
                </div>
                <h1 class="auth-title">Register</h1>
                <p class="auth-subtitle mb-3">Masukkan data Anda untuk mendaftar ke situs web kami.</p>
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
                    <a href="/auth/google/redirect" class="btn btn-block border shadow-lg">
                        <img alt="svgImg"
                            src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHg9IjBweCIgeT0iMHB4Igp3aWR0aD0iMjUiIGhlaWdodD0iMjUiCnZpZXdCb3g9IjAgMCA0OCA0OCI+CjxwYXRoIGZpbGw9IiNGRkMxMDciIGQ9Ik00My42MTEsMjAuMDgzSDQyVjIwSDI0djhoMTEuMzAzYy0xLjY0OSw0LjY1Ny02LjA4LDgtMTEuMzAzLDhjLTYuNjI3LDAtMTItNS4zNzMtMTItMTJjMC02LjYyNyw1LjM3My0xMiwxMi0xMmMzLjA1OSwwLDUuODQyLDEuMTU0LDcuOTYxLDMuMDM5bDUuNjU3LTUuNjU3QzM0LjA0Niw2LjA1MywyOS4yNjgsNCwyNCw0QzEyLjk1NSw0LDQsMTIuOTU1LDQsMjRjMCwxMS4wNDUsOC45NTUsMjAsMjAsMjBjMTEuMDQ1LDAsMjAtOC45NTUsMjAtMjBDNDQsMjIuNjU5LDQzLjg2MiwyMS4zNSw0My42MTEsMjAuMDgzeiI+PC9wYXRoPjxwYXRoIGZpbGw9IiNGRjNEMDAiIGQ9Ik02LjMwNiwxNC42OTFsNi41NzEsNC44MTlDMTQuNjU1LDE1LjEwOCwxOC45NjEsMTIsMjQsMTJjMy4wNTksMCw1Ljg0MiwxLjE1NCw3Ljk2MSwzLjAzOWw1LjY1Ny01LjY1N0MzNC4wNDYsNi4wNTMsMjkuMjY4LDQsMjQsNEMxNi4zMTgsNCw5LjY1Niw4LjMzNyw2LjMwNiwxNC42OTF6Ij48L3BhdGg+PHBhdGggZmlsbD0iIzRDQUY1MCIgZD0iTTI0LDQ0YzUuMTY2LDAsOS44Ni0xLjk3NywxMy40MDktNS4xOTJsLTYuMTktNS4yMzhDMjkuMjExLDM1LjA5MSwyNi43MTUsMzYsMjQsMzZjLTUuMjAyLDAtOS42MTktMy4zMTctMTEuMjgzLTcuOTQ2bC02LjUyMiw1LjAyNUM5LjUwNSwzOS41NTYsMTYuMjI3LDQ0LDI0LDQ0eiI+PC9wYXRoPjxwYXRoIGZpbGw9IiMxOTc2RDIiIGQ9Ik00My42MTEsMjAuMDgzSDQyVjIwSDI0djhoMTEuMzAzYy0wLjc5MiwyLjIzNy0yLjIzMSw0LjE2Ni00LjA4Nyw1LjU3MWMwLjAwMS0wLjAwMSwwLjAwMi0wLjAwMSwwLjAwMy0wLjAwMmw2LjE5LDUuMjM4QzM2Ljk3MSwzOS4yMDUsNDQsMzQsNDQsMjRDNDQsMjIuNjU5LDQzLjg2MiwyMS4zNSw0My42MTEsMjAuMDgzeiI+PC9wYXRoPgo8L3N2Zz4=" />
                        Daftar dengan Google</a>
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
