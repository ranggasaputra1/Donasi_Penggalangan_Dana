@extends('landing.master')
@section('content')
    <div class="mt-4 mb-4 py-4" style=" background-color: rgb(255, 255, 255);">
        <div class="container px-4">
            <h1 class="py-4 mb-4">Verifikasi Akun</h1>
        </div>
        @auth
            @if (is_null($verifikasi))
            <div class="container px-4">
                <form method="post" action="/kirim-verifikasi-akun"enctype="multipart/form-data" data-parsley-validate>
                    @csrf
                    <input type="hidden" class="form-control" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Nomor KTP</label>
                            <input type="number" class="form-control" name="nomor_ktp" required data-parsley-minlength="16"
                                data-parsley-maxlength="16" data-parsley-error-message="Nomor KTP Tidak Sesuai.">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Sesuai KTP</label>
                            <input type="text" class="form-control" name="nama_ktp" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Alamat</label>
                            <textarea type="text" class="form-control" name="alamat" required></textarea>
                        </div>
                    </div>
                    <div class="mt-2">
                        <strong>Foto KTP</strong>
                        <input class="form-control" type="file" name="foto_ktp" required>
                    </div>
                    <div class="mt-5 text-center">

                        <button type="submit" class="btn" style="background-color:#435ebe; color:#fff">Submit</button>
                    </div>
                </form>
            </div>
            @else
            <div class="container">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Status Verifikasi</h5>
                    <p style="margin-bottom:0px">
                        @if ($verifikasi->status_verifikasi == 0)
                            Pending
                        @endif
                        @if ($verifikasi->status_verifikasi == 1)
                            Disetujui
                        @endif
                        @if ($verifikasi->status_verifikasi == 2)
                            Ditolak
                        @endif
                </div>
            </div>
            @endif
        @else
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Anda Harus Login Terlebih Dahulu</h5>
            </div>
            <div class="centering p-4">
                <a href="{{ route('login') }}"><button type="submit" class="btn"
                        style="background-color:#435ebe; color:#fff">Login</button></a>
            </div>
        @endauth
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="/assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="/assets/js/pages/parsley.js"></script>
@endsection
