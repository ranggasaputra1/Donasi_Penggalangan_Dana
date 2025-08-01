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
                    <h3>Riwayat Donasi</h3>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">Riwayat Donasi yang Sudah Dikonfirmasi</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Donatur</th>
                                    <th>Judul Postingan</th>
                                    <th>Nama Penggalang Dana</th>
                                    <th>Nominal</th>
                                    <th>Tgl. Konfirmasi</th>
                                    <th>No. Rek Penggalang</th>
                                    <th>No. WA Penggalang</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayat as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_donatur }}</td>
                                        <td>{{ $item->campaign->judul_campaign ?? 'Kampanye Tidak Ditemukan' }}</td>
                                        <td>{{ $item->campaign->kuisioner->nama ?? 'Penggalang Dana Tidak Ditemukan' }}</td>
                                        <td>Rp. {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tgl_konfirmasi)->format('d-m-Y H:i:s') }}</td>
                                        <td>{{ $item->campaign->no_rekening ?? 'N/A' }}</td>
                                        <td>{{ $item->campaign->no_whatsapp ?? 'N/A' }}</td>
                                    </tr>
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
