@extends('landing.master')

@section('content')
    <style>
        body {
            background-color: #f9f9fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .donation-section {
            padding: 3rem 1rem;
        }

        .section-title {
            font-weight: 800;
            font-size: 2.25rem;
            color: #2c3e50;
        }

        .section-subtitle {
            font-size: 1.1rem;
            color: #6c757d;
        }

        .campaign-card {
            background-color: #fff;
            border-radius: 1.25rem;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: all 0.3s ease-in-out;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .campaign-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.08);
        }

        .campaign-image {
            height: 180px;
            overflow: hidden;
        }

        .campaign-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .campaign-card:hover .campaign-image img {
            transform: scale(1.05);
        }

        .campaign-body {
            padding: 1.25rem;
        }

        .campaign-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: #34495e;
            margin-bottom: 0.5rem;
        }

        .campaign-author {
            font-size: 0.85rem;
            color: #888;
            margin-bottom: 1rem;
        }

        .badge-kategori {
            background-color: #27ae60;
            color: #fff;
            font-size: 0.7rem;
            padding: 4px 10px;
            border-radius: 8px;
        }

        .progress {
            height: 6px;
            border-radius: 5px;
            background-color: #e9ecef;
            margin-bottom: 0.5rem;
        }

        .progress-bar {
            height: 100%;
            border-radius: 5px;
            transition: width 0.4s ease;
        }

        .campaign-meta {
            font-size: 0.85rem;
            color: #666;
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .sisa-hari {
            font-size: 0.8rem;
            color: #f39c12;
            font-weight: 600;
        }

        .btn-donasi {
            background: linear-gradient(to right, #5cd5a4, #3caea3);
            color: #fff;
            font-weight: 600;
            padding: 0.75rem 1.25rem;
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(60, 174, 163, 0.3);
            transition: all 0.3s ease;
        }

        .btn-donasi:hover {
            background: linear-gradient(to right, #3caea3, #2b908f);
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(60, 174, 163, 0.4);
        }


        @media (max-width: 768px) {
            .campaign-image {
                height: 160px;
            }
        }

        @media (max-width: 576px) {
            .campaign-image {
                height: 140px;
            }
        }
    </style>

    <div class="container donation-section">
        <div class="text-center mb-5">
            <h2 class="section-title">Semua Postingan Donasi</h2>
            <p class="section-subtitle">Bantu mereka yang membutuhkan💖</p>
        </div>

        <div class="row g-4">
            @forelse ($campaigns as $campaign)
                @php
                    $danaTerkumpul = $campaign->dana_terkumpul;
                    $target = $campaign->target_campaign;
                    $persentase = $target > 0 ? ($danaTerkumpul / $target) * 100 : 0;
                    $sisaHari = \Carbon\Carbon::parse($campaign->tgl_akhir_campaign)->diffInDays(\Carbon\Carbon::now());
                    $kategori = $campaign->kategori_pengajuan ?? 'Umum';
                @endphp

                <div class="col-12 col-sm-6 col-lg-4 d-flex">
                    <div class="campaign-card w-100">
                        <div>
                            <div class="campaign-image">
                                <img src="{{ asset('storage/images/campaign/' . $campaign->foto_campaign) }}"
                                    alt="{{ $campaign->judul_campaign }}">
                            </div>
                            <div class="campaign-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge-kategori">{{ ucfirst($kategori) }}</span>
                                    <span class="sisa-hari">⏳ {{ $sisaHari }} hari lagi</span>
                                </div>

                                <h5 class="campaign-title">{{ $campaign->judul_campaign }}</h5>
                                <p class="campaign-author">Oleh: {{ $campaign->kuisioner->nama ?? 'Tidak diketahui' }}</p>

                                <div class="progress">
                                    <div class="progress-bar {{ $persentase >= 100 ? 'bg-success' : 'bg-warning' }}"
                                        style="width: {{ $persentase }}%;" role="progressbar"
                                        aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>

                                <div class="campaign-meta">
                                    <span><strong>Rp {{ number_format($danaTerkumpul, 0, ',', '.') }}</strong></span>
                                    <span>Target: Rp {{ number_format($target, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="p-3">
                            <a href="{{ route('donasi.detail', $campaign->slug_campaign) }}" class="btn btn-donasi w-100">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Belum ada postingan donasi yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
