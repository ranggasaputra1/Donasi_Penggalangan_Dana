@extends('landing.master')
@section('content')
    <section data-filter="item" id="item" style="background-color: rgb(253, 253, 253);">
        <div class="container">
            <div class="row justify-content-center p-4">
                @if (count($campaign) > 0)
                    @foreach ($campaign as $item)
                        <a href="campaign/{{ $item->slug_campaign }}" class="item card hvr-grow m-2"
                            style="width: 18rem; padding: 0px;  border-color: #435ebe; text-decoration: none; color:black">
                            <img src="storage/{{ $item->foto_campaign }}" class="card-img-top" alt="..."
                                style="height: 250px; object-fit: cover;">
                            <div class="card-body">
                                <div class="card-title">
                                    <h5>{{ $item->judul_campaign }}</h5>
                                </div>
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar" role="progressbar" aria-label="Basic example"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                        style="background-color:#435ebe; width:{{ ($item->dana_terkumpul / $item->target_campaign) * 100 }}%">
                                    </div>
                                </div>
                                <p class="card-text mt-2">Donasi terkumpul : {{ $item->dana_terkumpul }}</p>
                                <p class="card-text">Aktif hingga :
                                    {{ date('d-m-Y', strtotime($item->tgl_akhir_campaign)) }}
                                </p>
                                <p class="card-text"> Status Campaign : @if ($item->status_campaign == 0)
                                        Pending
                                    @endif
                                    @if ($item->status_campaign == 1)
                                        Disetujui
                                    @endif
                                    @if ($item->status_campaign == 2)
                                        Ditolak
                                    @endif
                                    @if ($item->status_campaign == 3)
                                        Selesai
                                    @endif
                                </p>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div class="text-center">
                        <h3>Anda belum memiliki campaign</h3>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
