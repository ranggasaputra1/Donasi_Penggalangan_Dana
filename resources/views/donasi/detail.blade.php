@extends('landing.master')

@section('content')
    <style>
        body {
            background: #f5f8fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #2c3e50;
        }

        .campaign-detail {
            padding: 4rem 0;
        }

        .campaign-title {
            font-size: 2.3rem;
            font-weight: 800;
            color: #34495e;
            margin-bottom: 1rem;
        }

        .campaign-meta {
            font-size: 0.95rem;
            color: #7f8c8d;
            margin-bottom: 1rem;
        }

        .img-fluid {
            border-radius: 1.2rem;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        }

        .progress {
            height: 14px;
            border-radius: 30px;
            background-color: #e3e6eb;
            overflow: hidden;
        }

        .progress-bar {
            background: linear-gradient(to right, #00b09b, #96c93d);
        }

        .campaign-description {
            line-height: 1.8;
            font-size: 1.05rem;
            color: #2c3e50;
            background-color: #ffffff;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03);
        }

        .donation-card {
            border: none;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            padding: 2rem;
            background-color: #ffffff;
            position: sticky;
            top: 100px;
            transition: 0.4s;
        }

        .donation-card h4 {
            font-weight: 700;
            color: #2d3436;
            font-size: 1.4rem;
        }

        .form-control {
            border-radius: 0.75rem;
            border: 1px solid #ced4da;
            padding: 0.7rem;
            font-size: 0.95rem;
        }

        .form-label {
            font-weight: 500;
            margin-bottom: 0.3rem;
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

        .list-group-item {
            padding: 0.6rem 1rem;
            background-color: #fdfdfd;
            border: none;
            border-bottom: 1px solid #eee;
        }

        hr {
            border-top: 1px solid #ddd;
        }

        /* Animasi masuk */
        .campaign-detail .col-lg-8,
        .campaign-detail .col-lg-4 {
            animation: fadeInUp 0.6s ease both;
        }

        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>


    <div class="container campaign-detail">
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-5">
            <div class="col-lg-8">
                <img src="{{ asset('storage/images/campaign/' . $campaign->foto_campaign) }}"
                    class="img-fluid rounded-4 mb-4" alt="Foto Campaign">

                <h2 class="campaign-title">{{ $campaign->judul_campaign }}</h2>
                <div class="d-flex justify-content-between campaign-meta mb-3">
                    <div>Oleh: <strong>{{ $campaign->kuisioner->nama ?? 'Tidak Diketahui' }}</strong></div>
                    <div>Kategori: <strong>{{ ucfirst($campaign->kategori_pengajuan) }}</strong></div>
                </div>

                @php
                    $danaTerkumpul = $campaign->dana_terkumpul;
                    $target = $campaign->target_campaign;
                    $persentase = $target > 0 ? ($danaTerkumpul / $target) * 100 : 0;
                @endphp

                <div class="progress mb-2">
                    <div class="progress-bar" role="progressbar" style="width: {{ $persentase }}%"
                        aria-valuenow="{{ $persentase }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span><strong>Terkumpul:</strong> Rp {{ number_format($danaTerkumpul, 0, ',', '.') }}</span>
                    <span><strong>Target:</strong> Rp {{ number_format($target, 0, ',', '.') }}</span>
                </div>

                <p><strong>Sisa Waktu:</strong>
                    {{ \Carbon\Carbon::parse($campaign->tgl_akhir_campaign)->diffInDays(\Carbon\Carbon::now()) }} hari lagi
                </p>
                <hr>

                <h4 class="mb-3">Detail Penggalang Dana</h4>
                <ul class="list-group list-group-flush mb-4">
                    <li class="list-group-item"><strong>Pekerjaan:</strong> {{ $campaign->pekerjaan }}</li>
                    <li class="list-group-item"><strong>Kondisi Kesehatan:</strong> {{ $campaign->kondisi_kesehatan }}</li>
                    <li class="list-group-item"><strong>Kebutuhan Mendesak:</strong> {{ $campaign->kebutuhan_mendesak }}
                    </li>
                    <li class="list-group-item"><strong>Jumlah Tanggungan Keluarga:</strong>
                        {{ $campaign->jumlah_tanggungan_keluarga }} orang</li>
                    <li class="list-group-item"><strong>Status Korban:</strong> {{ $campaign->status_korban }}</li>
                </ul>
                <hr>

                <h4 class="mb-3">Deskripsi Kampanye</h4>
                <div class="campaign-description">
                    {!! $campaign->deskripsi_campaign !!}
                </div>
            </div>

            <div class="col-lg-4">
                <div class="donation-card">
                    <h4 class="text-center mb-4">Bantu Sekarang 💚</h4>

                    @auth
                        <form action="{{ route('donasi.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">

                            <div class="mb-3">
                                <label for="donor_name" class="form-label">Nama Donatur</label>
                                <input type="text" class="form-control" id="donor_name" name="donor_name"
                                    value="{{ Auth::user()->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="donor_email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="donor_email" name="donor_email"
                                    value="{{ Auth::user()->email }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="amount" class="form-label">Jumlah Donasi (min. Rp 10.000)</label>
                                <input type="number" class="form-control" id="amount" name="amount" min="10000"
                                    required>
                            </div>

                            <button type="submit" class="btn btn-donasi w-100">Donasi Sekarang</button>
                        </form>
                    @else
                        <div class="text-center p-3">
                            <p class="mb-4">Silakan login atau daftar untuk bisa berdonasi.</p>
                            <a href="/login" class="btn btn-donasi w-100">Login untuk Donasi</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
