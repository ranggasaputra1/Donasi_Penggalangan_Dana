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
                    <h3>Berita Campaign</h3>
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
                <div class="card-header d-flex justify-content-between">Berita Campaign
                    <a class="btn btn-primary" href="/admin/campaign/berita/tambah-berita">
                        <i class="bi bi-person-fill-add"></i> Tambah Berita
                    </a>
                </div>
                <div class="card-body">
                    <table class="table" id="table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Tanggal Terbit</th>
                                <th>Campaign</th>
                                <th>Penerbit</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 0 @endphp
                            @foreach ($news as $item)
                                <tr>
                                    @php $i++ @endphp
                                    <td>{{ $i }}</td>
                                    <td>{{ $item->judul_berita }}</td>
                                    <td>{{ $item->tgl_terbit_berita }}</td>
                                    <td>{{ $item->campaign->judul_campaign }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        <a href="/admin/campaign/berita/edit-berita/{{ $item->id }}" class="btn">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
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
                                                action="/admin/campaign/berita/hapus-berita">
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
@endsection
@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/js/pages/datatables.js"></script>
@endsection
