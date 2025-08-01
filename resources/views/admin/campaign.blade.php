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

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
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
                    <div class="table-responsive">
                        <table class="table" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>Nama Penggalang Dana</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Sisa Waktu Pengajuan</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($campaigns as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->judul_campaign }}</td>
                                        <td>{{ $item->kategori_pengajuan }}</td>
                                        <td>{{ $item->kuisioner->nama ?? 'Penggalang Dana Tidak Ditemukan' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->tgl_mulai_campaign)->format('d-m-Y') }}</td>
                                        <td>{{ $item->lama_pengajuan }} hari lagi</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="#" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#editCampaignModal{{ $item->id }}">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </a>
                                                <a href="/admin/campaign/campaign/lihat/{{ $item->id }}" class="btn">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                                <a href="#" class="btn text-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteCampaignModal{{ $item->id }}">
                                                    <i class="bi bi-trash-fill"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editCampaignModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="editCampaignModalLabel{{ $item->id }}" aria-hidden="true"
                                        data-bs-backdrop="static" data-bs-keyboard="false">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editCampaignModalLabel{{ $item->id }}">
                                                        Edit
                                                        Postingan Donasi</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('campaign.edit') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                                        <div class="mb-3">
                                                            <label for="judul_campaign" class="form-label">Judul
                                                                Campaign</label>
                                                            <input type="text" class="form-control" id="judul_campaign"
                                                                name="judul_campaign"
                                                                value="{{ old('judul_campaign', $item->judul_campaign) }}"
                                                                required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="penggalang_dana_id" class="form-label">Pilih
                                                                Penggalang
                                                                Dana</label>
                                                            <select name="penggalang_dana_id"
                                                                id="penggalang_dana_id_{{ $item->id }}"
                                                                class="form-select" required>
                                                                <option value="" disabled>Pilih Penggalang Dana
                                                                </option>
                                                                @foreach ($penggalangDanas as $penggalangDana)
                                                                    <option value="{{ $penggalangDana->id }}"
                                                                        {{ old('penggalang_dana_id', $item->penggalang_dana_id) == $penggalangDana->id ? 'selected' : '' }}>
                                                                        {{ $penggalangDana->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="foto_campaign" class="form-label">Foto Postingan
                                                                Donasi</label>
                                                            <input type="file" class="form-control" id="foto_campaign"
                                                                name="foto_campaign">
                                                            <div class="mt-2">
                                                                <img src="{{ asset('storage/images/campaign/' . $item->foto_campaign) }}"
                                                                    alt="Foto Campaign" width="150">
                                                            </div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="deskripsi_campaign" class="form-label">Deskripsi
                                                                Campaign</label>
                                                            <textarea class="form-control" id="deskripsi_campaign" name="deskripsi_campaign" required>{{ old('deskripsi_campaign', $item->deskripsi_campaign) }}</textarea>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btn-primary">Simpan
                                                                Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="deleteCampaignModal{{ $item->id }}" tabindex="-1"
                                        aria-labelledby="deleteCampaignModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="deleteCampaignModalLabel{{ $item->id }}">Konfirmasi Hapus
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus postingan donasi
                                                    "{{ $item->judul_campaign }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <a href="/admin/campaign/campaign/delete/{{ $item->id }}"
                                                        class="btn btn-danger">Hapus</a>
                                                </div>
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

    <div class="modal fade" id="createCampaignModal" tabindex="-1" aria-labelledby="createCampaignModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCampaignModalLabel">Tambah Postingan Donasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('campaign.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="judul_campaign" class="form-label">Judul Campaign</label>
                            <input type="text" class="form-control" id="judul_campaign" name="judul_campaign"
                                value="{{ old('judul_campaign') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="penggalang_dana_id" class="form-label">Pilih Penggalang Dana</label>
                            <select name="penggalang_dana_id" id="penggalang_dana_id" class="form-select" required>
                                <option value="" disabled selected>Pilih Penggalang Dana</option>
                                @foreach ($penggalangDanas as $penggalangDana)
                                    <option value="{{ $penggalangDana->id }}"
                                        {{ old('penggalang_dana_id') == $penggalangDana->id ? 'selected' : '' }}>
                                        {{ $penggalangDana->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="kuisioner-data" style="display:none;">
                            <div class="mb-3">
                                <label for="kategori_pengajuan" class="form-label">Kategori Pengajuan</label>
                                <input type="text" name="kategori_pengajuan" id="kategori_pengajuan"
                                    class="form-control" readonly>
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

                        <div class="mb-3">
                            <label for="foto_campaign" class="form-label">Foto Postingan Donasi</label>
                            <input type="file" class="form-control" id="foto_campaign" name="foto_campaign" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_campaign" class="form-label">Deskripsi Campaign</label>
                            <textarea class="form-control" id="deskripsi_campaign" name="deskripsi_campaign" required>{{ old('deskripsi_campaign') }}</textarea>
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
