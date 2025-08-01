@extends('landing.master')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-sm">
                    <h4 class="card-title text-center mb-4">Selesaikan Donasi Anda</h4>

                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h5 class="mt-4">Detail Donasi</h5>
                    <ul class="list-group list-group-flush mb-4">
                        <li class="list-group-item"><strong>Penggalang Dana</strong>
                            {{ $transaksi->campaign->judul_campaign }}
                        </li>
                        <li class="list-group-item"><strong>Nama Donatur:</strong> {{ $transaksi->nama }}</li>
                        <li class="list-group-item"><strong>Jumlah Donasi:</strong> Rp.
                            {{ number_format($transaksi->nominal_transaksi, 0, ',', '.') }}</li>
                    </ul>

                    <h5 class="mt-4">Informasi Pembayaran</h5>
                    <p class="card-text">Silakan transfer dana sejumlah donasi ke rekening di bawah ini:</p>
                    <div class="alert alert-info" role="alert">
                        <p class="mb-0"><strong>Bank:</strong> BNI</p>
                        <p class="mb-0"><strong>Nomor Rekening:</strong> {{ $transaksi->campaign->no_rekening_admin }}</p>
                        <p class="mb-0"><strong>Atas Nama:</strong> Admin We Care</p>
                    </div>

                    <h5 class="mt-4">Unggah Bukti Transfer</h5>
                    <form action="{{ route('donasi.upload.proof', $transaksi->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="proof" class="form-label">Unggah Bukti Transfer Anda</label>
                            <input class="form-control" type="file" id="proof" name="proof" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Konfirmasi Pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
