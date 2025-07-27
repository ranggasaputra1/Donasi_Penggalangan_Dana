@extends('landing.master')
@section('style')
    <link rel="stylesheet" href="/assets/css/main/blog.css">
@endsection
@section('content')
    <!-- Page Header-->
    @foreach ($berita as $item)
        <header class="masthead" style="background-image: url('{{asset('/storage/images/berita/'. $item->gambar_berita)}}')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1>{{ $item->judul_berita }}</h1>
                            <span class="meta">
                                Diterbitkan oleh {{ $item->user->name }}
                            </span>
                            <span class="meta">
                                Pada tanggal {{ date('d/m/Y', strtotime($item->tgl_terbit_berita)) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container p-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        {!! $item->isi_berita !!}
                    </div>
                </div>
            </div>
        </article>
    @endforeach
@endsection