@extends('landing.master')

@section('style')
    <link rel="stylesheet" href="/css/splide.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f2f6ff;
            color: #333;
        }

        h3,
        h5 {
            font-weight: 700;
            color: #435ebe;
        }

        .hvr-grow {
            transition: transform 0.4s ease, box-shadow 0.4s ease;
        }

        .hvr-grow:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .carousel-item img {
            border-radius: 12px;
        }

        .btn-custom {
            background: linear-gradient(90deg, #435ebe, #5c6ac4);
            color: #fff;
            border-radius: 50px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: linear-gradient(90deg, #5c6ac4, #435ebe);
            box-shadow: 0 4px 12px rgba(67, 94, 190, 0.3);
        }

        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
        }

        .card-title h5 {
            color: #435ebe;
            font-weight: 600;
        }

        .card-body {
            background-color: #fff;
        }

        .card-text {
            font-size: 0.9rem;
            color: #555;
        }

        .carousel-caption h5 {
            background-color: rgba(0, 0, 0, 0.4);
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
        }

        section {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
    </style>
@endsection

@section('content')
    <section id="hero" class="text-center" style="background-color: #fff;" data-aos="fade-down">
        <div class="container p-4">
            <h3>Selamat Datang!</h3>
            @auth
                <a href="{{ route('donasi.index') }}" class="hvr-grow d-block mt-4" data-aos="zoom-in">
                    <div
                        style="height: 250px; border-radius:25px;
                                background-image: linear-gradient(to right, #435ebe, rgba(231,231,231,0.5)),
                                                     url('https://images.unsplash.com/photo-1516570161787-2fd917215a3d?...&auto=format&fit=crop&w=1170&q=80');
                                background-size: cover;">
                        <div class="p-4" style="max-width: 80%; margin: auto;">
                            <h1 style="font-size: 2.5rem; color: #fff;">Donasi Sekarang</h1>
                        </div>
                    </div>
                </a>
            @else
                <a href="/" data-bs-toggle="modal" data-bs-target="#createCampaignModal" class="hvr-grow d-block mt-4"
                    data-aos="zoom-in">
                    <div
                        style="height: 250px; border-radius:25px;
                                background-image: linear-gradient(to right, #435ebe, rgba(231,231,231,0.5)),
                                                     url('https://images.unsplash.com/photo-1516570161787-2fd917215a3d?...&auto=format&fit=crop&w=1170&q=80');
                                background-size: cover;">
                        <div class="p-4" style="max-width: 80%; margin: auto;">
                            <h1 style="font-size: 2.5rem; color: #fff;">Galang Dana Sekarang</h1>
                        </div>
                    </div>
                </a>
            @endauth
        </div>

        {{-- Modal untuk Galang Dana / Login --}}
        <div class="modal fade" id="" tabindex="-1" aria-labelledby="createCampaignLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            @auth
                                Tatacara Galang Dana
                            @else
                                Hubungi Admin untuk Menggalang Dana
                            @endauth
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body text-center">
                        @auth
                            @if (Auth::user()->role == 2)
                                <p>Silakan isi form di bawah ini untuk mengajukan campaign donasi.</p>
                                <button type="button" class="btn btn-custom px-4 py-2 mt-3">Selanjutnya</button>
                            @else
                                <p>Anda perlu memverifikasi akun Anda untuk bisa membuat campaign.</p>
                                <a href="/verifikasi-akun/{{ Auth::user()->id }}"
                                    class="btn btn-custom px-4 py-2 mt-3">Verifikasi</a>
                            @endif
                        @else
                            <p>Anda perlu login atau mendaftar untuk bisa membuat campaign.</p>
                            <a href="/" class="btn btn-custom px-4 py-2 mt-3">Login / Daftar</a>
                        @endauth
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section data-aos="fade-up" class="bg-white">
        <div class="container text-center">
            <h5>Kategori Penggalangan Dana</h5>
            <div class="row mt-3 gy-4">
                @foreach (['pendidikan' => 'education', 'sosial' => 'social', 'kesehatan' => 'health'] as $slug => $icon)
                    <a href="/kategori/{{ $slug }}" class="col-6 col-md-4 hvr-grow text-decoration-none">
                        <div class="p-3 bg-white rounded shadow-sm">
                            <img src="{{ asset('assets/img/' . $icon . '.svg') }}" alt="{{ $slug }}"
                                style="height: 80px;">
                            <p class="mt-2">{{ ucfirst($slug) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section data-aos="fade-up" class="bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Penggalangan Dana Terbaru</h5>
            </div>
            <div class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($campaign as $item)
                            <li class="splide__slide">
                                <a href="/campaign/{{ $item->slug_campaign }}" class="text-decoration-none">
                                    <div class="card hvr-grow">
                                        <img src="{{ asset('/storage/' . $item->foto_campaign) }}" class="card-img-top"
                                            style="height:250px; object-fit:cover;">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5>{{ $item->judul_campaign }}</h5>
                                            </div>
                                            <div class="progress" style="height:8px;">
                                                <div class="progress-bar" role="progressbar"
                                                    style="background-color:#435ebe; width:{{ ($item->dana_terkumpul / $item->target_campaign) * 100 }}%;">
                                                </div>
                                            </div>
                                            <p class="card-text mt-2">Terkumpul:
                                                Rp{{ number_format($item->dana_terkumpul, 0, ',', '.') }}</p>
                                            <p class="card-text">Berakhir:
                                                {{ date('d‑m‑Y', strtotime($item->tgl_akhir_campaign)) }}</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section data-aos="fade-up" class="bg-white">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Artikel Terbaru</h5>
                <a href="/blog" class="btn btn-custom">Lihat Lainnya</a>
            </div>
            <div class="row">
                @foreach ($blog as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card hvr-grow">
                            <div class="card-body">
                                <h5 class="card-title"><a href="/blog/{{ $item->slug_blog }}"
                                        class="text-decoration-none">{{ $item->judul_blog }}</a></h5>
                                <p class="card-text">{!! Str::limit($item->isi_blog, 100) !!}</p>
                                <small class="text-muted">Diperbarui
                                    {{ date('d‑m‑Y', strtotime($item->updated_at)) }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor5/36.0.1/ckeditor.min.js" integrity="sha512-..."
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="/js/splide.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                once: true,
                duration: 800,
                offset: 50
            });
            var spl = new Splide('.splide', {
                perPage: window.innerWidth <= 480 ? 1 : 3,
                rewind: true,
                gap: '1rem',
            });
            spl.on('resize', function() {
                spl.options.perPage = window.innerWidth <= 480 ? 1 : 3;
                spl.refresh();
            });
            spl.mount();

            ClassicEditor.create(document.querySelector('#editor'), {
                extraPlugins: [SimpleUploadAdapterPlugin]
            }).catch(error => console.error(error));
        });
    </script>
@endsection
