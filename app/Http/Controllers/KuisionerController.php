<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KuisionerPenggalangDana;

class KuisionerController extends Controller
{
    const TITLE = 'Halaman Kuisioner - We Care';

    public function form()
    {
        return view('kuisioner.form', [
            'title' => self::TITLE,
        ]);
    }

    public function submit(Request $request)
{
    $data = $request->validate([
        'nama' => 'required|string|max:255',

        // KTP harus angka 16 digit
        'ktp' => 'required|digits:16',

        // Rekening angka min 6 digit
        'no_rekening' => 'required|numeric|min_digits:6',

        // Nomor WhatsApp valid: angka dengan +62 atau 08
        'no_whatsapp' => ['required','regex:/^(?:\+62|08)[0-9]{8,15}$/'],

        'kategori_pengajuan' => 'required|string',

        // Dana minimal 1000 agar tidak nol
        'jumlah_dana_dibutuhkan' => 'required|numeric|min:1000',

        'jumlah_tanggungan_keluarga' => 'required|integer|min:0|max:20',
        'pekerjaan' => 'required|string',
        'kondisi_kesehatan' => 'required|string',
        'status_rumah' => 'required|string',

        'ada_asuransi' => 'required|in:1,0',
        'kebutuhan_mendesak' => 'required|string',
        'lama_pengajuan' => 'required|string',

        // Penghasilan minimal 0
        'penghasilan_bulanan' => 'required|numeric|min:0',

        'punya_kendaraan' => 'required|in:1,0',
        'status_pernikahan' => 'required|string',
        'jumlah_anak' => 'required|integer|min:0|max:20',
        'status_korban' => 'required|string',
        'bantuan_pemerintah' => 'required|string',
    ], [
        'ktp.digits' => 'Nomor KTP harus 16 digit angka.',
        'no_rekening.numeric' => 'Nomor rekening harus berupa angka.',
        'no_rekening.min_digits' => 'Nomor rekening minimal 6 digit.',
        'no_whatsapp.regex' => 'Nomor WhatsApp harus diawali +62 atau 08 dan hanya berisi angka.',
        'jumlah_dana_dibutuhkan.min' => 'Jumlah dana minimal Rp 1.000.',
        'jumlah_tanggungan_keluarga.max' => 'Jumlah tanggungan maksimal 20 orang.',
        'jumlah_anak.max' => 'Jumlah anak maksimal 20 orang.'
    ]);

    KuisionerPenggalangDana::create($data);

    return redirect()->back()->with('success', 'Kuisioner berhasil dikirim!');
}
}