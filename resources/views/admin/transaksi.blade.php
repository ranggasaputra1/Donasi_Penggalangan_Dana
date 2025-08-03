@extends('layouts.master')
@section('style')
    <link rel="stylesheet" href="/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="/assets/css/pages/datatables.css" />
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
                                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#confirmModal{{ $item->id }}">Konfirmasi
                                                    Pembayaran</button>
                                            @else
                                                <small><span class="text-muted">Dana Berhasil Disalurkan</span></small>
                                            @endif
                                        </td>
                                    </tr>

                                    {{-- Modal Konfirmasi Pembayaran --}}
                                    @if ($item->status_transaksi == 0)
                                        <div class="modal fade" id="confirmModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="confirmModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmModalLabel">Konfirmasi Pembayaran
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('transaksi.confirm') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="transaksi_id"
                                                            value="{{ $item->id }}">
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin sudah mengirimkan dana sebesar **Rp.
                                                                {{ number_format($item->nominal_transaksi, 0, ',', '.') }}**
                                                                ke
                                                                penggalang dana untuk kampanye
                                                                **{{ $item->campaign->judul_campaign ?? 'Tidak Ditemukan' }}**?
                                                            </p>
                                                            <hr>
                                                            <div class="mb-3">
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
                                                            <hr>
                                                            <h6>Informasi Penggalang Dana</h6>
                                                            <p class="mb-1"><strong>No. Rekening:</strong>
                                                                {{ $item->campaign->no_rekening ?? 'N/A' }}</p>
                                                            <p><strong>No. WhatsApp:</strong>
                                                                {{ $item->campaign->no_whatsapp ?? 'N/A' }}</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Konfirmasi</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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
