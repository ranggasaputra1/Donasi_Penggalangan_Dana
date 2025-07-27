@extends('layouts.master')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Profil</h3>
                    <p class="text-subtitle text-muted">
                        Perbarui data pribadi Anda
                    </p>
                </div>
            </div>
        </div>
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

        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Pribadi</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST" action="/admin/profil-update"
                                    data-parsley-validate>
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>Nama</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input required type="text" class="form-control" name="name"
                                                    value="{{ old('name', Auth::user()->name) }}" />
                                            </div>
                                            <div class="col-md-4">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input required type="email" class="form-control" name="email"
                                                    value="{{ old('email', Auth::user()->email) }}"
                                                    data-parsley-type="email"
                                                    data-parsley-error-message="Masukkan format email yang valid." />
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nomor Telepon</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input required type="tel" class="form-control" name="phone_number"
                                                    placeholder="Nomor Telepon"
                                                    value="{{ old('phone_number', Auth::user()->phone_number) }}"
                                                    data-parsley-type="number"
                                                    data-parsley-error-message="Masukkan format nomor telepon yang valid." />
                                            </div>
                                            <div class="col-sm-12 d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary me-1 mb-1">Kirim</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Ganti Kata Sandi</h4>
                        </div>
                        @if (Auth::user()->google_id == null)
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-horizontal" method="POST" action="/admin/password-update"
                                        data-parsley-validate>
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">
                                                <input type="hidden" name="email"
                                                    value="{{ old('email', Auth::user()->email) }}" />
                                                <div class="col-md-4">
                                                    <label>Password Sekarang</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="password" class="form-control" name="password"
                                                        placeholder="Password Sekarang" data-parsley-minlength="8"
                                                        data-parsley-error-message="Kata sandi harus lebih besar dari atau sama dengan 8." />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Password Baru</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="password" id="password-baru" class="form-control"
                                                        name="password_baru" placeholder="Password Baru"
                                                        data-parsley-minlength="8"
                                                        data-parsley-error-message="Kata sandi harus lebih besar dari atau sama dengan 8." />
                                                </div>
                                                <div class="col-md-4">
                                                    <label>Konfirmasi Password</label>
                                                </div>
                                                <div class="col-md-8 form-group">
                                                    <input type="password" class="form-control" name="konfirmasi_password"
                                                        placeholder="Konfirmasi Password"
                                                        data-parsley-equalto="#password-baru"
                                                        data-parsley-error-message="Kata sandi tidak cocok." />
                                                </div>
                                                <div class="col-sm-12 d-flex justify-content-end">
                                                    <button type="submit" class="btn btn-primary me-1 mb-1">Kirim</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="card-content">
                                <div class="card-body">
                                    <p>Anda masuk menggunakan akun Google dan saat ini tidak dapat mengubah kata sandi.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="/assets/js/pages/parsley.js"></script>
@endsection
