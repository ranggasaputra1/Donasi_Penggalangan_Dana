@extends('landing.master')
@section('content')
    <section data-filter="item" id="item" style="background-color: rgb(253, 253, 253);">
        <div class="container">
            <div class="row justify-content-center p-4">
                @if (count($transaksi) > 0)
                    @foreach ($transaksi as $item)
                        <div class="card hvr-grow m-2"
                            style="width: 18rem; padding: 0px;  border-color: #435ebe; text-decoration: none; color:black">
                            {{-- <img src="storage/{{ $item->campaign['foto_campaign'] }}" class="card-img-top" alt="..." style="height: 250px; object-fit: cover;"> --}}
                            <div class="card-body">
                                <a href="campaign/{{ $item->campaign['slug_campaign'] }}" class="card-title"
                                    style="text-decoration: none; color:black">
                                    <h5>{{ $item->campaign->judul_campaign }}</h5>
                                </a>
                                <p class="card-text mt-2 mb-1">Donasi Anda : Rp{{ $item->nominal_transaksi }}</p>
                                {{-- <p class="card-text mb-1">ID donasi : {{ $item->id }}</p> --}}
                                <p class="card-text mb-1">Status : @if ($item->status_transaksi == 0)
                                        Belum Dibayar
                                    @elseif($item->status_transaksi == 1)
                                        Berhasil
                                    @elseif($item->status_transaksi == 2)
                                        Kadaluarsa
                                    @elseif($item->status_transaksi == 3)
                                        Dibatalkan
                                    @endif
                                </p>
                                @if ($item->status_transaksi == 0)
                                    <a href="/checkout/{{ $item->id }}"><button class="btn"
                                            style="background-color:#435ebe; color:#fff">Bayar Sekarang</button></a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="text-center">
                        <h3>Anda belum pernah berdonasi</h3>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
