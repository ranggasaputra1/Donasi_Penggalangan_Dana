@extends('landing.master')

@section('content')
    <style>
        .section-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .section-header h3 {
            font-weight: 700;
            font-size: 2rem;
            color: #2c3e50;
        }

        .section-header p {
            font-size: 1.1rem;
            color: #7f8c8d;
        }

        .card {
            border: none;
            border-radius: 1rem;
            background: #ffffff;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .table thead th {
            background-color: #f1f4f8;
            color: #2d3436;
            font-weight: 600;
            border-bottom: none;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .badge-success {
            background-color: #2ecc71 !important;
        }

        .badge-danger {
            background-color: #e74c3c !important;
        }

        .badge-warning {
            background-color: #f39c12 !important;
        }

        .no-data {
            text-align: center;
            font-size: 1.1rem;
            color: #95a5a6;
            padding: 2rem 0;
        }
    </style>

    <div class="container my-5">
        <div class="row">
            <div class="col-12 section-header">
                <h3><i class="bi bi-clock-history me-2"></i>Riwayat Donasi Saya</h3>
                <p class="lead">Berikut adalah daftar donasi yang telah Anda lakukan.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Postingan Donasi</th>
                                    <th>Nominal</th>
                                    <th>Tgl. Donasi</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Bukti Transfer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($transaksi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $item->campaign->judul_campaign ?? 'Kampanye Tidak Ditemukan' }}</strong>
                                        </td>
                                        <td>Rp. {{ number_format($item->nominal_transaksi, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tgl_transaksi)->format('d-m-Y') }}</td>
                                        <td>
                                            @if ($item->status_transaksi == 0)
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif ($item->status_transaksi == 1)
                                                <span class="badge badge-success">Sukses</span>
                                            @elseif ($item->status_transaksi == 2)
                                                <span class="badge badge-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status_transaksi == 1)
                                                <small>Dana Donasi Berhasil Disalurkan</small>
                                            @elseif ($item->status_transaksi == 2)
                                                <small>{{ $item->keterangan_admin ?? 'Tidak ada keterangan.' }}</small>
                                            @else
                                                <small>-</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->keterangan)
                                                <a href="{{ asset('storage/images/proofs/' . $item->keterangan) }}"
                                                    target="_blank">
                                                    <img src="{{ asset('storage/images/proofs/' . $item->keterangan) }}"
                                                        alt="Bukti Transfer"
                                                        style="width: 80px; height: 80px; object-fit: cover;">
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="no-data">
                                            <i class="bi bi-info-circle me-2"></i>Anda belum memiliki riwayat donasi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
