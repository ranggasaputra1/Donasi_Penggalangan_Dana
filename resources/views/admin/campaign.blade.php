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
                    <h3>Postingan Donasi</h3>
                </div>
            </div>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success alert-dismissible show fade" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCampaignModal">Tambah Postingan
                Donasi</button>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    Postingan Donasi
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
                            @foreach ($campaign as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->judul_campaign }}</td>
                                    <td>{{ $item->category->nama_kategori }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->tgl_mulai_campaign }}</td>
                                    <td>{{ $item->tgl_akhir_campaign }}</td>
                                    <td>{{ $item->status_campaign == 0 ? 'Pending' : ($item->status_campaign == 1 ? 'Disetujui' : 'Ditolak') }}
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>

    <!-- Modal untuk menambah campaign -->
    <div class="modal fade" id="createCampaignModal" tabindex="-1" aria-labelledby="createCampaignModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCampaignModalLabel">Tambah Postingan Donasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('campaign.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="judul_campaign" class="form-label">Judul Campaign</label>
                            <input type="text" class="form-control" id="judul_campaign" name="judul_campaign" required>
                        </div>


                        <!-- Pilih Penggalang Dana -->
                        <div class="mb-3">
                            <label for="penggalang_dana_id" class="form-label">Pilih Penggalang Dana</label>
                            <select name="penggalang_dana_id" id="penggalang_dana_id" class="form-select" required>
                                <option value="" disabled selected>Pilih Penggalang Dana</option>
                                @foreach ($penggalangDanas as $penggalangDana)
                                    <option value="{{ $penggalangDana->id }}">{{ $penggalangDana->nama }} -
                                        {{ $penggalangDana->kategori_pengajuan }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Data Kuisioner Penggalang Dana -->
                        <div id="kuisioner-data" style="display:none;">
                            <div class="mb-3">
                                <label for="kategori_pengajuan" class="form-label">Kategori Pengajuan</label>
                                <input type="text" name="kategori_pengajuan" id="kategori_pengajuan" class="form-control"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_dana_dibutuhkan" class="form-label">Jumlah Dana Dibutuhkan</label>
                                <input type="number" name="jumlah_dana_dibutuhkan" id="jumlah_dana_dibutuhkan"
                                    class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="jumlah_tanggungan_keluarga" class="form-label">Jumlah Tanggungan
                                    Keluarga</label>
                                <input type="number" name="jumlah_tanggungan_keluarga" id="jumlah_tanggungan_keluarga"
                                    class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="kondisi_kesehatan" class="form-label">Kondisi Kesehatan</label>
                                <input type="text" name="kondisi_kesehatan" id="kondisi_kesehatan"
                                    class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="kebutuhan_mendesak" class="form-label">Kebutuhan Mendesak</label>
                                <input type="text" name="kebutuhan_mendesak" id="kebutuhan_mendesak"
                                    class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="lama_pengajuan" class="form-label">Lama Pengajuan</label>
                                <input type="text" name="lama_pengajuan" id="lama_pengajuan" class="form-control"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="status_korban" class="form-label">Status Korban</label>
                                <input type="text" name="status_korban" id="status_korban" class="form-control"
                                    readonly>
                            </div>
                        </div>

                        <!-- Foto Campaign -->
                        <div class="mb-3">
                            <label for="foto_campaign" class="form-label">Foto Campaign</label>
                            <input type="file" class="form-control" id="foto_campaign" name="foto_campaign" required>
                        </div>

                        <!-- Deskripsi Campaign -->
                        <div class="mb-3">
                            <label for="deskripsi_campaign" class="form-label">Deskripsi Campaign</label>
                            <textarea class="form-control" id="deskripsi_campaign" name="deskripsi_campaign" required></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Buat Postingan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="/assets/js/pages/datatables.js"></script>

    <script>
        $(document).ready(function() {
            $('#penggalang_dana_id').change(function() {
                var penggalangDanaId = $(this).val();
                if (penggalangDanaId) {
                    $.ajax({
                        url: '/admin/campaign/get-penggalang-dana/' + penggalangDanaId,
                        type: 'GET',
                        success: function(response) {
                            $('#kategori_pengajuan').val(response.kategori_pengajuan);
                            $('#jumlah_dana_dibutuhkan').val(response.jumlah_dana_dibutuhkan);
                            $('#jumlah_tanggungan_keluarga').val(response
                                .jumlah_tanggungan_keluarga);
                            $('#pekerjaan').val(response.pekerjaan);
                            $('#kondisi_kesehatan').val(response.kondisi_kesehatan);
                            $('#kebutuhan_mendesak').val(response.kebutuhan_mendesak);
                            $('#lama_pengajuan').val(response.lama_pengajuan);
                            $('#status_korban').val(response.status_korban);
                            $('#kuisioner-data').show();
                        },
                        error: function() {
                            alert('Terjadi kesalahan saat mengambil data penggalang dana.');
                        }
                    });
                } else {
                    $('#kuisioner-data').hide();
                }
            });
        });
    </script>
@endsection
