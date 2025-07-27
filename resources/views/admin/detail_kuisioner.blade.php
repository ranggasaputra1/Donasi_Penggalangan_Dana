@extends('layouts.master')

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Detail Kuisioner</h3>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-header">
                    Detail Kuisioner: {{ $data->nama }}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Nama</th>
                                <td>{{ $data->nama }}</td>
                            </tr>
                            <tr>
                                <th>KTP</th>
                                <td>{{ $data->ktp }}</td>
                            </tr>
                            <tr>
                                <th>No Rekening</th>
                                <td>{{ $data->no_rekening }}</td>
                            </tr>
                            <tr>
                                <th>No WhatsApp</th>
                                <td>{{ $data->no_whatsapp }}</td>
                            </tr>
                            <tr>
                                <th>Kategori Pengajuan</th>
                                <td>{{ ucfirst($data->kategori_pengajuan) }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Dana Dibutuhkan</th>
                                <td>Rp {{ number_format($data->jumlah_dana_dibutuhkan, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Tanggungan</th>
                                <td>{{ $data->jumlah_tanggungan_keluarga }}</td>
                            </tr>
                            <tr>
                                <th>Pekerjaan</th>
                                <td>{{ $data->pekerjaan }}</td>
                            </tr>
                            <tr>
                                <th>Kondisi Kesehatan</th>
                                <td>{{ $data->kondisi_kesehatan }}</td>
                            </tr>
                            <tr>
                                <th>Status Rumah</th>
                                <td>{{ $data->status_rumah }}</td>
                            </tr>
                            <tr>
                                <th>Ada Asuransi</th>
                                <td>{{ $data->ada_asuransi ? 'Ya' : 'Tidak' }}</td>
                            </tr>
                            <tr>
                                <th>Kebutuhan Mendesak</th>
                                <td>{{ $data->kebutuhan_mendesak }}</td>
                            </tr>
                            <tr>
                                <th>Lama Pengajuan</th>
                                <td>{{ $data->lama_pengajuan }}</td>
                            </tr>
                            <tr>
                                <th>Penghasilan Bulanan</th>
                                <td>Rp {{ number_format($data->penghasilan_bulanan, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Punya Kendaraan</th>
                                <td>{{ $data->punya_kendaraan ? 'Ya' : 'Tidak' }}</td>
                            </tr>
                            <tr>
                                <th>Status Pernikahan</th>
                                <td>{{ $data->status_pernikahan }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Anak</th>
                                <td>{{ $data->jumlah_anak }}</td>
                            </tr>
                            <tr>
                                <th>Status Korban</th>
                                <td>{{ $data->status_korban }}</td>
                            </tr>
                            <tr>
                                <th>Bantuan Pemerintah</th>
                                <td>{{ $data->bantuan_pemerintah }}</td>
                            </tr>
                            <tr>
                                <th>Status ACC</th>
                                <td>
                                    @if ($data->status_acc == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($data->status_acc == 'layak')
                                        <span class="badge bg-success">Layak</span>
                                    @else
                                        <span class="badge bg-danger">Tidak Layak</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>

                    {{-- ✅ Tombol ACC --}}
                    <div class="mt-3 d-flex gap-2">
                        <a href="{{ url('/admin/penggalang-dana/kuisioner/acc/' . $data->id . '/layak') }}"
                            class="btn btn-success">
                            ACC Layak
                        </a>
                        <a href="{{ url('/admin/penggalang-dana/kuisioner/acc/' . $data->id . '/tidak') }}"
                            class="btn btn-danger">
                            Tidak Layak
                        </a>
                        <a href="{{ url('/admin/penggalang-dana/kuisioner') }}" class="btn btn-secondary">
                            Kembali
                        </a>
                    </div>
                </div>
                <tr>
                    <th>Persentase Kelayakan</th>
                    <td>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar 
                @if ($relevansi >= 70) bg-success 
                @elseif($relevansi >= 50) bg-warning 
                @else bg-danger @endif"
                                role="progressbar" style="width: {{ $relevansi }}%">
                                {{ $relevansi }}%
                            </div>
                        </div>
                    </td>
                </tr>


            </div>
        </section>
    </div>
@endsection
