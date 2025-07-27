@extends('landing.master')
@section('content')
    <section id="category" style=" background-color: rgb(255, 255, 255);">
        {{-- <div style="height:60px"></div> --}}
        <div class="container text-center">
            <h5 class="p-4 mt-2" style="font-weight:bold; color: #435ebe;">Kategori @if ($kat == 1)
                    Pendidikan
                @endif
                @if ($kat == 2)
                    Sosial
                @endif
                @if ($kat == 3)
                    Kesehatan
                @endif
            </h5>
            <button class="btn" style="border-radius: 50px; background-color:#435ebe"><a href="/"
                    style="color: #ffffff; text-decoration:none">
                    <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1"
                        viewBox="0 0 1024 1024">
                        <path
                            d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z"
                            fill="#ffffff"></path>
                    </svg>
                    <span>Kembali</span></a>
            </button>
        </div>
        <div class="container">
            <div class="row justify-content-center p-4">
                @foreach ($campaign as $item)
                    <a href="/campaign/{{ $item->slug_campaign }}" class="item card hvr-grow m-2"
                        data-filter="{{ $item->category_id }}"
                        style="width: 18rem; padding: 0px;  border-color: #435ebe; text-decoration: none; color:black">
                        <img src="{{ asset('/storage/' . $item->foto_campaign) }}" class="card-img-top" alt="..."
                            style="height: 250px; object-fit: cover;">
                        <div class="card-body">
                            <div class="card-title">
                                <h5>{{ $item->judul_campaign }}</h5>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar" role="progressbar" aria-label="Basic example" aria-valuenow="75"
                                    aria-valuemin="0" aria-valuemax="100"
                                    style="background-color:#435ebe; width:{{ ($item->dana_terkumpul / $item->target_campaign) * 100 }}%">
                                </div>
                            </div>
                            <p class="card-text mt-2">Donasi terkumpul : Rp{{ number_format($item->dana_terkumpul, 2, ',', '.') }}</p>
                            <p class="card-text">Aktif hingga : {{ date('d-m-Y', strtotime($item->tgl_akhir_campaign)) }}
                            </p>
                        </div>
                    </a>
                @endforeach

                <nav class="my-4" aria-label="...">
                    <ul class="pagination pagination-circle justify-content-center">
                        {{ $campaign->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@endsection
@section('script')
@endsection
