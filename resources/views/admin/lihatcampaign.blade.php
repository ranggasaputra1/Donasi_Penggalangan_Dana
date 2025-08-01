@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Postingan Donasi</h3>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $campaign->judul_campaign }}</h4>
                    <span class="badge bg-primary">{{ $campaign->kategori_pengajuan }}</span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/images/campaign/' . $campaign->foto_campaign) }}"
                                class="img-fluid rounded" alt="Foto Campaign">
                        </div>
                        <div class="col-md-8">
                            <h5 class="mt-3">Detail Donasi</h5>
                            <p><b>Penggalang Dana:</b> {{ $campaign->kuisioner->nama ?? 'Tidak Diketahui' }}</p>
                            <p><b>Tanggal Mulai:</b> {{ $campaign->tgl_mulai_campaign->format('d-m-Y') }}</p>
                            <p><b>Tanggal Berakhir:</b>
                                {{ \Carbon\Carbon::parse($campaign->tgl_akhir_campaign)->format('d-m-Y') }}</p>
                            <p><b>Dana Terkumpul:</b> Rp. {{ number_format($campaign->dana_terkumpul, 0, ',', '.') }}</p>
                            <p><b>Target Donasi:</b> Rp. {{ number_format($campaign->jumlah_dana_dibutuhkan, 0, ',', '.') }}
                            </p>

                            <hr>
                            <h5 class="mt-3">Data Penggalang Dana</h5>
                            <p><b>Pekerjaan:</b> {{ $campaign->pekerjaan }}</p>
                            <p><b>Jumlah Tanggungan Keluarga:</b> {{ $campaign->jumlah_tanggungan_keluarga }}</p>
                            <p><b>Kondisi Kesehatan:</b> {{ $campaign->kondisi_kesehatan }}</p>
                            <p><b>Kebutuhan Mendesak:</b> {{ $campaign->kebutuhan_mendesak }}</p>
                            <p><b>Lama Pengajuan:</b> {{ $campaign->lama_pengajuan }} hari</p>
                            <p><b>Status Korban:</b> {{ $campaign->status_korban }}</p>
                            <hr>
                            <h5 class="mt-3">Deskripsi Lengkap</h5>
                            <div class="card-text">
                                {!! $campaign->deskripsi_campaign !!}
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-4">
                        <a href="{{ url('/admin/campaign/campaign') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
