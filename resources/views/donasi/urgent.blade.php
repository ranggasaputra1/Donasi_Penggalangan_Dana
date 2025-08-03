@extends('landing.master')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap');
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

        :root {
            --primary-color: #3caea3;
            --primary-hover: #2b908f;
            --accent-color: #f39c12;
            --text-color: #2c3e50;
            --light-text-color: #7f8c8d;
            --bg-color: #f0f4f8;
            --card-bg: #ffffff;
            --shadow-light: 0 4px 15px rgba(0, 0, 0, 0.05);
            --shadow-strong: 0 12px 30px rgba(0, 0, 0, 0.1);
            --urgent-color: #e74c3c;
            --urgent-hover: #c0392b;
        }

        body {
            background-color: var(--bg-color);
            font-family: 'Poppins', sans-serif;
            color: var(--text-color);
            line-height: 1.6;
        }

        .donation-section {
            padding: 4rem 1rem;
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
            opacity: 0;
            /* Animasi awal */
            transform: translateY(20px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        }

        .section-header h2 {
            font-size: 2rem;
            font-weight: 800;
            color: var(--urgent-color);
            margin-bottom: 0.5rem;
        }

        .section-header p {
            font-size: 1rem;
            color: var(--text-color);
            max-width: 700px;
            margin: 0 auto;
        }

        /* Animasi untuk kartu donasi */
        .campaign-card {
            background-color: var(--card-bg);
            border-radius: 1.5rem;
            box-shadow: var(--shadow-light);
            overflow: hidden;
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            height: 100%;
            display: flex;
            flex-direction: column;

            /* Gaya awal untuk efek animasi */
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .campaign-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-strong);
        }

        /* Kelas yang akan ditambahkan oleh JS untuk memicu animasi */
        .campaign-card.animate-in {
            opacity: 1;
            transform: translateY(0);
        }

        /* Gaya sisanya sama dengan halaman donasi biasa */
        .campaign-image-container {
            position: relative;
            height: 180px;
            overflow: hidden;
        }

        .campaign-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .campaign-card:hover .campaign-image-container img {
            transform: scale(1.08);
        }

        .campaign-overlay-badges {
            position: absolute;
            top: 1rem;
            left: 1rem;
            z-index: 10;
        }

        .badge-urgent {
            background-color: var(--urgent-color);
            color: #fff;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 5px 12px;
            border-radius: 12px;
            letter-spacing: 0.5px;
        }

        .campaign-body {
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            flex-grow: 1;
        }

        .campaign-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-color);
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .campaign-description {
            font-size: 0.9rem;
            color: var(--light-text-color);
            margin-bottom: 1rem;
            height: 40px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .badge-kategori {
            background: linear-gradient(45deg, #5cd5a4, #3caea3);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 12px;
            letter-spacing: 0.5px;
        }

        .progress-wrapper {
            margin-top: 1rem;
            margin-bottom: 0.75rem;
        }

        .progress {
            height: 8px;
            border-radius: 10px;
            background-color: #eef2f6;
            position: relative;
        }

        .progress-bar {
            height: 100%;
            border-radius: 10px;
            background: linear-gradient(to right, #5cd5a4, #3caea3);
            transition: width 0.6s ease-in-out;
        }

        .campaign-meta {
            font-size: 0.9rem;
            color: var(--light-text-color);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .meta-item strong {
            font-weight: 700;
            color: var(--text-color);
        }

        .meta-item i {
            color: var(--accent-color);
            margin-right: 0.25rem;
        }

        .meta-item-donatur i {
            color: #e74c3c;
        }

        .btn-donasi {
            background: linear-gradient(to right, #5cd5a4, #3caea3);
            color: #fff;
            font-weight: 700;
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(60, 174, 163, 0.25);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            letter-spacing: 0.5px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-donasi:hover {
            background: linear-gradient(to right, #3caea3, #2b908f);
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 12px 25px rgba(60, 174, 163, 0.4);
        }
    </style>

    <div class="container donation-section">
        {{-- Header Baru untuk Halaman Urgent --}}
        <div class="section-header">
            <h2>"Ditemukan! Donasi Paling Urgent Mari Segera Bantu✨"</h2>
            <p>"Waktu terus berjalan. Kampanye ini membutuhkan uluran tangan Anda secepatnya untuk mencapai target. Setiap
                donasi Anda sangat berarti.❤️"
            </p>
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
                        <div class="campaign-image-container">
                            <img src="{{ asset('storage/images/campaign/' . $campaign->foto_campaign) }}"
                                alt="{{ $campaign->judul_campaign }}">
                            <div class="campaign-overlay-badges">
                                <span class="badge-urgent"><i class="fas fa-fire me-1"></i> Mendesak!</span>
                            </div>
                        </div>

                        <div class="campaign-body">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge-kategori">{{ ucfirst($kategori) }}</span>
                                    <span class="sisa-hari text-end">
                                        <i class="far fa-clock"></i> Sisa: {{ $sisaHari }} hari
                                    </span>
                                </div>

                                <h5 class="campaign-title">{{ $campaign->judul_campaign }}</h5>
                                <p class="campaign-description">
                                    {{ Str::limit(strip_tags($campaign->deskripsi_campaign), 80) }}</p>

                                <div class="progress-wrapper">
                                    <div class="progress">
                                        <div class="progress-bar"
                                            style="width: {{ $persentase > 100 ? 100 : $persentase }}%;" role="progressbar"
                                            aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>

                                <div class="campaign-meta">
                                    <span class="meta-item"><i class="fas fa-hand-holding-heart"></i><strong>
                                            Rp{{ number_format($danaTerkumpul, 0, ',', '.') }}</strong></span>
                                    <span>Target: Rp {{ number_format($target, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('donasi.detail', $campaign->slug_campaign) }}"
                                    class="btn btn-donasi w-100">
                                    <i class="fas fa-donate"></i> Berikan Donasi Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p>Saat ini belum ada postingan donasi mendesak. Terima kasih atas kepedulian Anda!</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sectionHeader = document.querySelector('.section-header');
            const campaignCards = document.querySelectorAll('.campaign-card');

            // Memunculkan header halaman dengan delay
            setTimeout(() => {
                sectionHeader.style.opacity = '1';
                sectionHeader.style.transform = 'translateY(0)';
            }, 300);

            // Memunculkan setiap kartu donasi dengan delay
            campaignCards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('animate-in');
                }, 600 + (index * 150));
            });
        });
    </script>
@endsection
