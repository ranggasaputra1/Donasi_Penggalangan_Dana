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
                    <h3>Kategori Campaign</h3>
                </div>
            </div>
        </div>
        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible show fade" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('salah'))
            <div class="alert alert-danger alert-dismissible show fade" role="alert">
                {{ session('salah') }}
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
                <div class="card-header d-flex justify-content-between">Kategori Campaign
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahkategori">
                        <i class="bi bi-person-fill-add"></i> Tambah Kategori
                    </button>
                </div>
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0 @endphp
                            @foreach ($kategori as $item)
                                <tr>
                                    @php $i++ @endphp
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->nama_kategori }}</td>
                                    <td>
                                        <button type="button" class="btn" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $item->id }}">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </td>
                                </tr>
                                <div class="modal fade" id="delete{{ $item->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                        role="document">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">
                                                    Apakah Anda yakin?
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    Anda tidak akan dapat memulihkan data ini!
                                                </p>
                                            </div>
                                            <form class="form form-vertical" method="POST"
                                                action="/admin/campaign/kategori/hapus-kategori">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $item->id }}" />
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Batal</span>
                                                    </button>
                                                    <button type="submit" class="btn btn-primary ml-1">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Hapus</span>
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
    <!--login form Modal -->
    <div class="modal fade text-left" id="tambahkategori" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">
                        Tambah Kategori
                    </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form method="POST" action="/admin/campaign/kategori/tambah-kategori" data-parsley-validate>
                    @csrf
                    <div class="modal-body">
                        <label>Kategori: </label>
                        <div class="form-group">
                            <input required type="text" name="nama_kategori" placeholder="Kategori"
                                class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Tambah</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/js/pages/datatables.js"></script>
    <script src="/assets/extensions/parsleyjs/parsley.min.js"></script>
    <script src="/assets/js/pages/parsley.js"></script>
@endsection
