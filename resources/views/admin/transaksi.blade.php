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

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">Data Transaksi Donasi</div>
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Donatur</th>
                                <th>Nama Campaign</th>
                                <th>Tanggal Donasi</th>
                                <th>Nominal Donasi</th>
                                <th>Keterangan</th>
                                <th>Status Donasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0 @endphp
                            @foreach ($transaksi as $item)
                                <tr>
                                    @php $i++ @endphp
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->campaign->judul_campaign }}</td>
                                    <td>{{ $item->tgl_transaksi }}</td>
                                    <td>{{ $item->nominal_transaksi }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        @if ($item->status_transaksi == 0)
                                            Pending
                                        @endif
                                        @if ($item->status_transaksi == 1)
                                            Sukses
                                        @endif
                                        @if ($item->status_transaksi == 2)
                                            Kedaluwarsa
                                        @endif
                                        @if ($item->status_transaksi == 2)
                                            Dibatalkan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <!-- Basic Tables end -->
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/js/pages/datatables.js"></script>
@endsection
