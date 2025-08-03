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

        .hero-banner {
            background: linear-gradient(135deg, #3caea3, #2b908f);
            color: white;
            border-radius: 1.5rem;
            padding: 1.5rem 1rem;
            text-align: center;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-strong);
        }

        .hero-banner .section-title {
            color: white;
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 0.3rem;
        }

        .hero-banner .section-subtitle {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.85rem;
            font-weight: 400;
            max-width: 600px;
            margin: 0 auto;
        }

        .campaign-filter-sort {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 3rem;
        }

        .filter-btn {
            background: var(--card-bg);
            border: 1px solid #e0e6ed;
            color: var(--text-color);
            padding: 0.75rem 1.5rem;
            border-radius: 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            box-shadow: var(--shadow-light);
        }

        .campaign-card {
            background-color: var(--card-bg);
            border-radius: 1.5rem;
            box-shadow: var(--shadow-light);
            overflow: hidden;
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94), box-shadow 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            height: 100%;
            display: flex;
            flex-direction: column;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInSlideUp 0.8s forwards;
        }

        @keyframes fadeInSlideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .campaign-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-strong);
        }

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
            background-color: #e74c3c;
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

        .recent-donations {
            background: #fff;
            border-radius: 1.5rem;
            padding: 2rem;
            margin-top: 3rem;
            box-shadow: var(--shadow-light);
        }

        .recent-donations-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 0;
            border-bottom: 1px solid #ecf0f1;
        }

        .recent-donations-item:last-child {
            border-bottom: none;
        }

        .recent-donations-item .user-avatar {
            width: 50px;
            height: 50px;
            background: var(--bg-color);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.25rem;
            color: var(--primary-color);
        }

        /* Gaya baru untuk tombol donasi mendesak */
        .urgent-cta-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .btn-urgent {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 700;
            color: white;
            background: linear-gradient(135deg, var(--urgent-color), var(--urgent-hover));
            border: none;
            border-radius: 2rem;
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(231, 76, 60, 0.25);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            letter-spacing: 0.5px;
            text-transform: uppercase;
            cursor: pointer;
        }

        .btn-urgent:hover {
            color: white;
            background: linear-gradient(135deg, var(--urgent-hover), #e74c3c);
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(231, 76, 60, 0.4);
        }

        .btn-urgent i {
            margin-right: 0.5rem;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        @media (max-width: 768px) {
            .hero-banner {
                padding: 2rem 1rem;
                margin-bottom: 2rem;
            }

            .hero-banner .section-title {
                font-size: 1.75rem;
            }

            .hero-banner .section-subtitle {
                font-size: 1rem;
            }

            .urgent-cta-wrapper {
                justify-content: center;
                padding-right: 0;
            }

            .btn-urgent {
                width: 100%;
            }

            .campaign-image-container {
                height: 160px;
            }

            .campaign-filter-sort {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        /* Gaya CSS untuk loading screen yang diperbarui */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.95);
            display: none;
            /* Awalnya disembunyikan */
            justify-content: center;
            align-items: center;
            flex-direction: column;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

        .loading-overlay.visible {
            display: flex;
            /* Ditampilkan saat kelas 'visible' ditambahkan */
            opacity: 1;
            visibility: visible;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 5px solid var(--primary-color);
            border-bottom-color: transparent;
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }

        .loading-text {
            margin-top: 1rem;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-color);
        }

        @keyframes rotation {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <div id="loading-overlay" class="loading-overlay">
        <div class="loading-spinner"></div>
        <div class="loading-text">Sedang menjalankan algoritma Naive Bayes...</div>
    </div>

    <div class="container donation-section">
        {{-- Hero Banner --}}
        <div class="hero-banner text-center">
            <h2 class="section-title">Ulurkan Tangan, Sebarkan Harapan. ✨</h2>
            <p class="section-subtitle">Kebaikan kecil Anda adalah perubahan besar. Pilih Postingan Donasi yang menyentuh
                hati dan
                wujudkan dampak positif yang nyata. ❤️</p>
        </div>

        {{-- Tombol Donasi Urgent Baru --}}
        <div class="urgent-cta-wrapper">
            <button id="btn-urgent" class="btn-urgent">
                <i class="fas fa-fire"></i> DONASI URGENT
            </button>
        </div>

        <div class="row g-4">
            @forelse ($campaigns as $campaign)
                @php
                    $danaTerkumpul = $campaign->dana_terkumpul;
                    $target = $campaign->target_campaign;
                    $persentase = $target > 0 ? ($danaTerkumpul / $target) * 100 : 0;
                    $sisaHari = \Carbon\Carbon::parse($campaign->tgl_akhir_campaign)->diffInDays(\Carbon\Carbon::now());
                    $kategori = $campaign->kategori_pengajuan ?? 'Umum';
                    $isUrgent = $sisaHari < 7;
                    $description = strip_tags($campaign->deskripsi_campaign);
                @endphp

                <div class="col-12 col-sm-6 col-lg-4 d-flex">
                    <div class="campaign-card w-100" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                        <div class="campaign-image-container">
                            <img src="{{ asset('storage/images/campaign/' . $campaign->foto_campaign) }}"
                                alt="{{ $campaign->judul_campaign }}">
                            @if ($isUrgent)
                                <div class="campaign-overlay-badges">
                                    <span class="badge-urgent"><i class="fas fa-fire me-1"></i> Mendesak!</span>
                                </div>
                            @endif
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
                                <p class="campaign-description">{{ Str::limit($description, 80) }}</p>

                                <div class="progress-wrapper">
                                    <div class="progress">
                                        <div class="progress-bar"
                                            style="width: {{ $persentase > 100 ? 100 : $persentase }}%;" role="progressbar"
                                            aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100">
                                        </div>
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
                    <p>Saat ini belum ada postingan donasi yang aktif. Terima kasih atas niat baik Anda!</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urgentBtn = document.getElementById('btn-urgent');
            const loadingOverlay = document.getElementById('loading-overlay');
            const targetUrl = '{{ route('donasi.urgent') }}';

            // Event listener untuk saat halaman pertama kali dimuat atau kembali dari cache
            window.addEventListener('pageshow', function(event) {
                // `persisted` adalah properti yang menunjukkan apakah halaman dimuat dari back-forward cache
                if (event.persisted) {
                    loadingOverlay.style.display = 'none';
                    loadingOverlay.classList.remove('visible');
                }
            });

            urgentBtn.addEventListener('click', function(e) {
                e.preventDefault();

                loadingOverlay.style.display = 'flex';
                loadingOverlay.classList.add('visible');

                setTimeout(function() {
                    window.location.href = targetUrl;
                }, 2500);
            });
        });
    </script>
@endsection
