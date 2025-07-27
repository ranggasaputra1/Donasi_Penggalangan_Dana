<?php

namespace App\Http\Controllers;

use App\Models\KuisionerPenggalangDana;
use Illuminate\Http\Request;

class AdminKuisionerController extends Controller
{
    const TITLE = 'Kuisioner Penggalang Dana - We Care';

    /** ✅ Tampilkan Data Kuisioner */
    public function index()
    {
        $kuisioner = KuisionerPenggalangDana::orderBy('created_at', 'desc')->get();

        return view('admin.kuisioner', [
            'title' => self::TITLE,
            'kuisioner' => $kuisioner,
        ]);
    }

    /** ✅ ACC Layak/Tidak */
    public function acc($id, $status)
    {
        $data = KuisionerPenggalangDana::findOrFail($id);

        // Hitung persentase kelayakan
        $relevansi = $this->hitungRelevansi($data);

        if ($status == 'layak' && $relevansi >= 50) {
            $data->status_acc = 'layak';
        } else {
            $data->status_acc = 'tidak_layak';
        }

        $data->save();

        return redirect()->back()->with('success', 'Status ACC diperbarui!');
    }

    /** ✅ Detail Kuisioner + Persentase Kelayakan */
    public function detail($id)
    {
        $data = KuisionerPenggalangDana::findOrFail($id);

        // Hitung persentase kelayakan
        $relevansi = $this->hitungRelevansi($data);

        return view('admin.detail_kuisioner', [
            'title' => 'Detail Kuisioner - We Care',
            'data' => $data,
            'relevansi' => $relevansi,
        ]);
    }

    /** ✅ Hitung Relevansi Otomatis (versi diperkuat) */
    private function hitungRelevansi($data)
    {
        $skor = 0;
        $total_bobot = 0;

        // 1. Jumlah Tanggungan Keluarga (20%)
        $bobot_tanggungan = 20;
        $total_bobot += $bobot_tanggungan;
        if ($data->jumlah_tanggungan_keluarga >= 5) {
            $skor += $bobot_tanggungan;
        } elseif ($data->jumlah_tanggungan_keluarga >= 3) {
            $skor += $bobot_tanggungan * 0.7;
        } elseif ($data->jumlah_tanggungan_keluarga >= 1) {
            $skor += $bobot_tanggungan * 0.4;
        }

        // 2. Penghasilan Bulanan (25%)
        $bobot_penghasilan = 25;
        $total_bobot += $bobot_penghasilan;
        if ($data->penghasilan_bulanan < 1000000) {
            $skor += $bobot_penghasilan;
        } elseif ($data->penghasilan_bulanan < 3000000) {
            $skor += $bobot_penghasilan * 0.7;
        } elseif ($data->penghasilan_bulanan < 5000000) {
            $skor += $bobot_penghasilan * 0.4;
        }

        // 3. Kondisi Kesehatan (15%)
        $bobot_kesehatan = 15;
        $total_bobot += $bobot_kesehatan;
        $kesehatan = strtolower($data->kondisi_kesehatan);
        if ($kesehatan == 'sakit parah') {
            $skor += $bobot_kesehatan;
        } elseif ($kesehatan == 'sakit ringan') {
            $skor += $bobot_kesehatan * 0.7;
        }

        // 4. Status Rumah (10%)
        $bobot_rumah = 10;
        $total_bobot += $bobot_rumah;
        $rumah = strtolower($data->status_rumah);
        if ($rumah == 'tidak punya rumah') {
            $skor += $bobot_rumah;
        } elseif ($rumah == 'kontrak') {
            $skor += $bobot_rumah * 0.7;
        }

        // 5. Ada Asuransi (5%)
        $bobot_asuransi = 5;
        $total_bobot += $bobot_asuransi;
        if ($data->ada_asuransi == 0) {
            $skor += $bobot_asuransi;
        }

        // 6. Jumlah Anak (10%)
        $bobot_anak = 10;
        $total_bobot += $bobot_anak;
        if ($data->jumlah_anak >= 3) {
            $skor += $bobot_anak;
        } elseif ($data->jumlah_anak >= 1) {
            $skor += $bobot_anak * 0.6;
        }

        // 7. Status Korban (10%)
        $bobot_korban = 10;
        $total_bobot += $bobot_korban;
        if (strtolower($data->status_korban) != 'tidak') {
            $skor += $bobot_korban;
        }

        // 8. Kebutuhan Mendesak (5%)
        $bobot_mendesak = 5;
        $total_bobot += $bobot_mendesak;
        if (!empty($data->kebutuhan_mendesak)) {
            $skor += $bobot_mendesak;
        }

        // ✅ Hitung Persentase
        $persentase = round(($skor / $total_bobot) * 100, 2);
        return $persentase;
    }
}
