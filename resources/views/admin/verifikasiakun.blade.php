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
                    <h3>Data Verifikasi Akun</h3>
                </div>
            </div>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible show fade" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible show fade" role="alert">
                    {{ $error }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endforeach
        @endif

        <!-- Basic Tables start -->
        <section class="section">
            <div class="card">
                <div class="card-header">Data Verifikasi Akun</div>
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Nomor KTP</th>
                                <th>Nama Sesuai KTP</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Foto KTP</th>
                                <th>Status</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0 @endphp
                            @foreach ($verifikasiakun as $item)
                                <tr>
                                    @php $i++ @endphp
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->nomor_ktp }}</td>
                                    <td>{{ $item->nama_ktp }}</td>
                                    <td>{{ $item->tanggal_lahir }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td><img src="{{ asset('/storage/' . $item->foto_ktp) }}" height="150px" alt="">
                                    </td>
                                    <td>
                                        @if ($item->status_verifikasi == 0)
                                            Pending
                                        @endif
                                        @if ($item->status_verifikasi == 1)
                                            Disetujui
                                        @endif
                                        @if ($item->status_verifikasi == 2)
                                            Ditolak
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $item->id }}">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade text-left" id="edit{{ $item->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel33">
                                                    Edit Status
                                                </h4>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form action="/admin/penggalang-dana/edit-status-verifikasi-akun"
                                                method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <label>Edit Status</label>
                                                    <div class="form-group">
                                                        <input type="hidden" name="id" value="{{ $item->user_id }}">
                                                        <select class="form-select" id="basicSelect" name="status">
                                                            <option disabled selected
                                                                value="{{ $item->status_verifikasi }}">
                                                                @if ($item->status_verifikasi == 0)
                                                                    Pending
                                                                @endif
                                                                @if ($item->status_verifikasi == 1)
                                                                    Disetujui
                                                                @endif
                                                                @if ($item->status_verifikasi == 2)
                                                                    Ditolak
                                                                @endif
                                                            </option>
                                                            <option value="1">Disetujui</option>
                                                            <option value="2">Ditolak</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Batal</span>
                                                    </button>
                                                    <button type="submit" class="btn btn-primary ml-1"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Ubah</span>
                                                    </button>
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
        </section>
        <!-- Basic Tables end -->
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/js/pages/datatables.js"></script>
@endsection
