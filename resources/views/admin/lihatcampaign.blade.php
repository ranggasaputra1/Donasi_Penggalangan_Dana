@extends('layouts.master')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Lihat Campaign</h3>
                </div>
            </div>
        </div>

        <!-- Basic Vertical form layout section start -->
        <section id="basic-vertical-layouts">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Lihat Campaign</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                    <div class="form-body">
                                        @foreach ($campaign as $item)
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Judul Campaign</label>
                                                        <p>{{ $item->judul_campaign }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-vertical">Penggalang Dana</label>
                                                        <p>{{ $item->user->name }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="isi-vertical">Tanggal Mulai Campaign</label>
                                                        <p>{{ $item->tgl_mulai_campaign }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="isi-vertical">Tanggal Akhir Campaign</label>
                                                        <p>{{ $item->tgl_akhir_campaign }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="isi-vertical">Target Campaign</label>
                                                        <p>Rp{{ number_format($item->target_campaign, 2, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="gambar-vertical">Foto Campaign</label>
                                                        <img src="/storage/{{ $item->foto_campaign }}" width="100%" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group" style="figure.img{width=10px}">
                                                        <label for="isi-vertical">Deskripsi Campaign</label>
                                                        {!! str_replace('<img', '<img style="width: 100%"', $item->deskripsi_campaign) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <a href="/admin/campaign/campaign" class="btn btn-primary me-1 mb-1">
                                                    Kembali
                                                </a>
                                            </div>
                                    </div>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <!-- // Basic Vertical form layout section end -->
    </div>
@endsection
@section('script')

@endsection
