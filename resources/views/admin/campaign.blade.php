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
                    <h3>Data Campaign</h3>
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
                <div class="card-header d-flex justify-content-between">Data Campaign
                </div>
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penggalang Dana</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Akhir</th>
                                <th>Status</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0 @endphp
                            @foreach ($campaign as $item)
                                <tr>
                                    @php $i++ @endphp
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->judul_campaign }}</td>
                                    <td>{{ $item->category->nama_kategori }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->tgl_mulai_campaign }}</td>
                                    <td>{{ $item->tgl_akhir_campaign }}</td>
                                    <td>
                                        @if ($item->status_campaign == 0)
                                            Pending
                                        @endif
                                        @if ($item->status_campaign == 1)
                                            Disetujui
                                        @endif
                                        @if ($item->status_campaign == 2)
                                            Ditolak
                                        @endif
                                        @if ($item->status_campaign == 3)
                                            Selesai
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $item->id }}">
                                            <i class="bi bi-pencil-fill"></i>
                                        </button>
                                        <a href="/admin/campaign/campaign/lihat/{{ $item->id }}" class="btn">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
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
                                            <form action="/admin/campaign/campaign/edit-status-campaign"
                                                method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <label>Edit Status</label>
                                                    <input type="hidden" class="form-control" name="id"
                                                        value="{{ $item->id }}">
                                                    <div class="form-group">
                                                        <select class="form-select" id="basicSelect" name="status">
                                                            <option disabled selected value="{{ $item->status_campaign }}">
                                                                @if ($item->status_campaign == 0)
                                                                    Pending
                                                                @endif
                                                                @if ($item->status_campaign == 1)
                                                                    Disetujui
                                                                @endif
                                                                @if ($item->status_campaign == 2)
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
        </section>
        <!-- Basic Tables end -->
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/js/pages/datatables.js"></script>
@endsection
