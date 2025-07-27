@extends('landing.master')
@section('content')
    <section style=" background-color: rgb(255, 255, 255);">
        <div class="container mt-4 mb-4">
            <h1 class="py-4 mb-4">Profil</h1>
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
            <div>
                <h4 class="card-title">Data Pribadi</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form class="form" method="POST" action="/profil-update" data-parsley-validate>
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <label>Nama</label>
                                </div>
                                <div class="col-md-8 form-group mt-3">
                                    <input required type="text" class="form-control" name="name"
                                        value="{{ old('name', Auth::user()->name) }}" />
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label>Email</label>
                                </div>
                                <div class="col-md-8 form-group mt-3">
                                    <input required type="email" class="form-control" name="email"
                                        value="{{ old('email', Auth::user()->email) }}" data-parsley-type="email"
                                        data-parsley-error-message="Masukkan format email yang valid." />
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label>Nomor Telepon</label>
                                </div>
                                <div class="col-md-8 form-group mt-3">
                                    <input required type="tel" class="form-control" name="phone_number"
                                        placeholder="Nomor Telepon"
                                        value="{{ old('phone_number', Auth::user()->phone_number) }}"
                                        data-parsley-type="number"
                                        data-parsley-error-message="Masukkan format nomor telepon yang valid." />
                                </div>
                                <div class="col-sm-12 d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Kirim</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <h4 class="card-title">Ganti Kata Sandi</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    @if (Auth::user()->google_id == null)
                        <form class="form" method="POST" action="/password-update" data-parsley-validate>
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <input type="hidden" name="email" value="{{ old('email', Auth::user()->email) }}" />
                                    <div class="col-md-4 mt-3">
                                        <label>Password Sekarang</label>
                                    </div>
                                    <div class="col-md-8 form-group mt-3">
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Password Sekarang" data-parsley-minlength="8"
                                            data-parsley-error-message="Kata sandi harus lebih besar dari atau sama dengan 8." />
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label>Password Baru</label>
                                    </div>
                                    <div class="col-md-8 form-group mt-3">
                                        <input type="password" id="password-baru" class="form-control" name="password_baru"
                                            placeholder="Password Baru" data-parsley-minlength="8"
                                            data-parsley-error-message="Kata sandi harus lebih besar dari atau sama dengan 8." />
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <label>Konfirmasi Password</label>
                                    </div>
                                    <div class="col-md-8 form-group mt-3">
                                        <input type="password" class="form-control" name="konfirmasi_password"
                                            placeholder="Konfirmasi Password" data-parsley-equalto="#password-baru"
                                            data-parsley-error-message="Kata sandi tidak cocok." />
                                    </div>
                                    <div class="col-sm-12 d-flex justify-content-end mt-3">
                                        <button type="submit" class="btn btn-primary me-1 mb-1">Kirim</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    @else
                        <p>Anda masuk menggunakan akun Google dan saat ini tidak dapat mengubah kata sandi.</p>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="/assets/js/pages/parsley.js"></script>
@endsection
