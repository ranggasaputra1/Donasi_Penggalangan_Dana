<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kuisioner - We Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery-mask-plugin@1.14.15/dist/jquery.mask.min.js"></script>
    <style>
        body {
            background: linear-gradient(135deg, #f0f4ff, #ffffff);
            font-family: 'Poppins', sans-serif;
        }

        .form-card {
            background: #fff;
            border-radius: 15px;
            padding: 2rem;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .form-title {
            font-weight: 600;
            color: #435ebe;
        }

        label.form-label {
            font-weight: 500;
        }

        .btn-primary {
            background-color: #435ebe;
            border: none;
            font-weight: 600;
            padding: 12px;
        }

        .btn-primary:hover {
            background-color: #364b98;
        }

        .btn-close-form {
            position: absolute;
            right: 15px;
            top: 15px;
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: #999;
            transition: color 0.2s ease-in-out;
        }

        .btn-close-form:hover {
            color: #333;
        }
    </style>
</head>

<body>

    <div class="container my-5">
        <div class="form-card">
            <!-- Tombol X -->
            <a href="/" class="btn-close-form" aria-label="Close">&times;</a>

            <h3 class="mb-4 text-center form-title">Form Kuisioner Penggalang Dana</h3>

            @if (session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
            @endif

            <form action="/kuisioner" method="POST">
                @csrf

                <!-- Nama Lengkap -->
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Nomor KTP -->
                <div class="mb-3">
                    <label class="form-label">Nomor KTP (hanya angka)</label>
                    <input type="text" name="ktp" class="form-control" value="{{ old('ktp') }}" required>
                    @error('ktp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Nomor Rekening -->
                <div class="mb-3">
                    <label class="form-label">Nomor Rekening (hanya angka)</label>
                    <input type="text" name="no_rekening" class="form-control" value="{{ old('no_rekening') }}"
                        required>
                    @error('no_rekening')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Nomor WhatsApp -->
                <div class="mb-3">
                    <label class="form-label">Nomor WhatsApp (format: +62xxx / 08xxx)</label>
                    <input type="text" name="no_whatsapp" class="form-control" value="{{ old('no_whatsapp') }}"
                        required>
                    @error('no_whatsapp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Kategori Pengajuan -->
                <div class="mb-3">
                    <label class="form-label">Kategori Pengajuan</label>
                    <select name="kategori_pengajuan" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="darurat" {{ old('kategori_pengajuan') == 'darurat' ? 'selected' : '' }}>
                            Kemanusiaan
                        </option>
                        <option value="pendidikan" {{ old('kategori_pengajuan') == 'pendidikan' ? 'selected' : '' }}>
                            Pendidikan
                        </option>
                        <option value="kesehatan" {{ old('kategori_pengajuan') == 'kesehatan' ? 'selected' : '' }}>
                            Kesehatan
                        </option>
                    </select>
                    @error('kategori_pengajuan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Jumlah Dana -->
                <div class="mb-3">
                    <label class="form-label">Jumlah Dana Dibutuhkan (hanya angka)</label>
                    <input type="text" name="jumlah_dana_dibutuhkan" class="form-control"
                        value="{{ old('jumlah_dana_dibutuhkan') }}" id="jumlah_dana_dibutuhkan" required>
                    @error('jumlah_dana_dibutuhkan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Jumlah Tanggungan -->
                <div class="mb-3">
                    <label class="form-label">Jumlah Tanggungan Keluarga (angka)</label>
                    <input type="number" name="jumlah_tanggungan_keluarga" class="form-control"
                        value="{{ old('jumlah_tanggungan_keluarga') }}" required>
                    @error('jumlah_tanggungan_keluarga')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Pekerjaan -->
                <div class="mb-3">
                    <label class="form-label">Pekerjaan (contoh: Buruh/ Pegawai)</label>
                    <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan') }}"
                        required>
                    @error('pekerjaan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Kondisi Kesehatan -->
                <div class="mb-3">
                    <label class="form-label">Kondisi Kesehatan (contoh: Sehat / Menderita Penyakit X)</label>
                    <input type="text" name="kondisi_kesehatan" class="form-control"
                        value="{{ old('kondisi_kesehatan') }}" required>
                    @error('kondisi_kesehatan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Status Rumah -->
                <div class="mb-3">
                    <label class="form-label">Status Rumah</label>
                    <select name="status_rumah" class="form-select" required>
                        <option value="milik" {{ old('status_rumah') == 'milik' ? 'selected' : '' }}>Milik Sendiri
                        </option>
                        <option value="kontrak" {{ old('status_rumah') == 'kontrak' ? 'selected' : '' }}>Kontrak/Sewa
                        </option>
                        <option value="numpang" {{ old('status_rumah') == 'numpang' ? 'selected' : '' }}>Numpang
                        </option>
                    </select>
                    @error('status_rumah')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Ada Asuransi -->
                <div class="mb-3">
                    <label class="form-label">Ada Asuransi?</label>
                    <select name="ada_asuransi" class="form-select" required>
                        <option value="1" {{ old('ada_asuransi') == '1' ? 'selected' : '' }}>Ya</option>
                        <option value="0" {{ old('ada_asuransi') == '0' ? 'selected' : '' }}>Tidak</option>
                    </select>
                    @error('ada_asuransi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Kebutuhan Mendesak -->
                <div class="mb-3">
                    <label class="form-label">Kebutuhan Mendesak (contoh: Pengobatan, Pendidikan)</label>
                    <input type="text" name="kebutuhan_mendesak" class="form-control"
                        value="{{ old('kebutuhan_mendesak') }}" required>
                    @error('kebutuhan_mendesak')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Lama Pengajuan -->
                <div class="mb-3">
                    <label class="form-label">Lama Pengajuan (hari)</label>
                    <input type="text" name="lama_pengajuan" class="form-control"
                        value="{{ old('lama_pengajuan') }}" required>
                    @error('lama_pengajuan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Penghasilan Bulanan -->
                <div class="mb-3">
                    <label class="form-label">Penghasilan Bulanan (angka)</label>
                    <input type="number" name="penghasilan_bulanan" class="form-control"
                        value="{{ old('penghasilan_bulanan') }}" required>
                    @error('penghasilan_bulanan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Punya Kendaraan -->
                <div class="mb-3">
                    <label class="form-label">Punya Kendaraan?</label>
                    <select name="punya_kendaraan" class="form-select" required>
                        <option value="1" {{ old('punya_kendaraan') == '1' ? 'selected' : '' }}>Ya</option>
                        <option value="0" {{ old('punya_kendaraan') == '0' ? 'selected' : '' }}>Tidak</option>
                    </select>
                    @error('punya_kendaraan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Status Pernikahan -->
                <div class="mb-3">
                    <label class="form-label">Status Pernikahan</label>
                    <select name="status_pernikahan" class="form-select" required>
                        <option value="lajang" {{ old('status_pernikahan') == 'lajang' ? 'selected' : '' }}>Lajang
                        </option>
                        <option value="menikah" {{ old('status_pernikahan') == 'menikah' ? 'selected' : '' }}>Menikah
                        </option>
                        <option value="duda/janda" {{ old('status_pernikahan') == 'duda/janda' ? 'selected' : '' }}>
                            Duda/Janda</option>
                    </select>
                    @error('status_pernikahan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Jumlah Anak -->
                <div class="mb-3">
                    <label class="form-label">Jumlah Anak</label>
                    <input type="number" name="jumlah_anak" class="form-control" value="{{ old('jumlah_anak') }}"
                        required>
                    @error('jumlah_anak')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Status Korban -->
                <div class="mb-3">
                    <label class="form-label">Status Korban (contoh: korban bencana alam, kecelakaan, dll)</label>
                    <input type="text" name="status_korban" class="form-control"
                        value="{{ old('status_korban') }}" required>
                    @error('status_korban')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Bantuan Pemerintah -->
                <div class="mb-3">
                    <label class="form-label">Bantuan Pemerintah yang Pernah Diterima</label>
                    <input type="text" name="bantuan_pemerintah" class="form-control"
                        value="{{ old('bantuan_pemerintah') }}" required>
                    @error('bantuan_pemerintah')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-3">Kirim Kuisioner</button>
            </form>
        </div>
    </div>

</body>

</html>
