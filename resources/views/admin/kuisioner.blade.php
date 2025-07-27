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
                    <h3>Data Kuisioner Penggalang Dana</h3>
                </div>
            </div>
        </div>

        {{-- ✅ Alert --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible show fade" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <section class="section">
            <div class="card">
                <div class="card-header">Data Kuisioner</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Jumlah Dana</th>
                                    <th>Tanggungan</th>
                                    <th>Penghasilan</th>
                                    <th>No WhatsApp</th>
                                    <th>Status ACC</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0 @endphp
                                @foreach ($kuisioner as $item)
                                    <tr>
                                        @php $i++ @endphp
                                        <td>{{ $i }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ ucfirst($item->kategori_pengajuan) }}</td>
                                        <td>Rp {{ number_format($item->jumlah_dana_dibutuhkan, 0, ',', '.') }}</td>
                                        <td>{{ $item->jumlah_tanggungan_keluarga }}</td>
                                        <td>Rp {{ number_format($item->penghasilan_bulanan, 0, ',', '.') }}</td>
                                        <td>{{ $item->no_whatsapp }}</td>
                                        <td>
                                            @if ($item->status_acc == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($item->status_acc == 'layak')
                                                <span class="badge bg-success">Layak</span>
                                            @else
                                                <span class="badge bg-danger">Tidak Layak</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- ✅ Tombol Detail sesuai standar --}}
                                            <a href="{{ url('/admin/penggalang-dana/kuisioner/detail/' . $item->id) }}"
                                                class="btn" title="Lihat Detail">
                                                <i class="bi bi-pencil-fill"></i> Detail
                                            </a>
                                        </td>
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
