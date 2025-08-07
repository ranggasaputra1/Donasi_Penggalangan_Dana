@extends('layouts.master')
@section('style')
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="/assets/css/pages/datatables.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <style>
        .btn-action {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-action i {
            margin-right: 5px;
        }

        .btn-action.btn-confirm {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .btn-action.btn-confirm:hover {
            background-color: #218838;
            border-color: #1e7e34;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.2);
        }

        .btn-action.btn-reject {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .btn-action.btn-reject:hover {
            background-color: #c82333;
            border-color: #bd2130;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
        }

        .modal-body img {
            max-height: 250px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
            margin-top: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Transaksi Donasi</h3>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">Data Transaksi Donasi</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Donatur</th>
                                    <th>Judul Postingan</th>
                                    <th>Nominal</th>
                                    <th>Tgl. Transaksi</th>
                                    <th>Status</th>
                                    <th>Keterangan Admin</th>
                                    <th>Bukti Transfer</th>
                                    <th>No. Rek Penggalang</th>
                                    <th>No. WA Penggalang</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name ?? $item->nama }}</td>
                                        <td>{{ $item->campaign->judul_campaign ?? 'Kampanye Tidak Ditemukan' }}</td>
                                        <td>Rp. {{ number_format($item->nominal_transaksi, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tgl_transaksi)->format('d-m-Y') }}</td>
                                        <td>
                                            @if ($item->status_transaksi == 0)
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif ($item->status_transaksi == 1)
                                                <span class="badge bg-success">Sukses</span>
                                            @elseif ($item->status_transaksi == 2)
                                                <span class="badge bg-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status_transaksi == 2)
                                                <small>{{ $item->keterangan_admin ?? 'Tidak ada keterangan.' }}</small>
                                            @else
                                                -
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
                                        <td>{{ $item->campaign->no_rekening ?? 'N/A' }}</td>
                                        <td>{{ $item->campaign->no_whatsapp ?? 'N/A' }}</td>
                                        <td>
                                            @if ($item->status_transaksi == 0)
                                                <div class="d-flex flex-column gap-2">
                                                    <button class="btn btn-primary btn-action" data-bs-toggle="modal"
                                                        data-bs-target="#confirmModal{{ $item->id }}">
                                                        <i class="fas fa-check"></i>Konfirmasi</button>
                                                    <button class="btn btn-sm btn-reject btn-action" data-bs-toggle="modal"
                                                        data-bs-target="#rejectModal{{ $item->id }}">
                                                        <i class="fas fa-times"></i>Tolak</button>
                                                </div>
                                            @else
                                                <small><span class="text-muted">Proses Selesai</span></small>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Modal Konfirmasi Pembayaran --}}
                                    <div class="modal fade" id="confirmModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="confirmModalLabel{{ $item->id }}" aria-hidden="true"
                                        data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmModalLabel{{ $item->id }}">
                                                        Konfirmasi Pembayaran</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('transaksi.confirm') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="transaksi_id" value="{{ $item->id }}">
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin sudah mengirimkan dana sebesar **Rp.
                                                            {{ number_format($item->nominal_transaksi, 0, ',', '.') }}**
                                                            ke penggalang dana untuk kampanye
                                                            **{{ $item->campaign->judul_campaign ?? 'Tidak Ditemukan' }}**?
                                                        </p>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6 mb-3">
                                                                <h6>Bukti Transfer Donatur:</h6>
                                                                @if ($item->keterangan)
                                                                    <a href="{{ asset('storage/images/proofs/' . $item->keterangan) }}"
                                                                        target="_blank">
                                                                        <img src="{{ asset('storage/images/proofs/' . $item->keterangan) }}"
                                                                            alt="Bukti Transfer" class="img-fluid"
                                                                            style="max-height: 200px;">
                                                                    </a>
                                                                @else
                                                                    <p>Tidak ada bukti transfer diunggah.</p>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <h6>Informasi Penggalang Dana</h6>
                                                                <p class="mb-1"><strong>No. Rekening:</strong>
                                                                    {{ $item->campaign->no_rekening ?? 'N/A' }}</p>
                                                                <p><strong>No. WhatsApp:</strong>
                                                                    {{ $item->campaign->no_whatsapp ?? 'N/A' }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Modal Tolak Donasi --}}
                                    <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="rejectModalLabel{{ $item->id }}" aria-hidden="true"
                                        data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="rejectModalLabel{{ $item->id }}">
                                                        Tolak Donasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('transaksi.reject') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="transaksi_id" value="{{ $item->id }}">
                                                    <div class="modal-body">
                                                        <p>Anda akan membatalkan donasi ini. Silakan berikan keterangan
                                                            mengapa donasi ini dibatalkan. Lalu hubungi donatur terkait
                                                            pengembalian dana donasi</p>
                                                        <div class="mb-3 mt-3">
                                                            <label for="keterangan_admin" class="form-label">Keterangan
                                                                (Wajib)
                                                            </label>
                                                            <textarea class="form-control" name="keterangan_admin" id="keterangan_admin" rows="3" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Tolak</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/js/pages/datatables.js"></script>
@endsection
