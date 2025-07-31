<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuisionerPenggalangDana extends Model
{
    use HasFactory;

    protected $table = 'kuisioner_penggalang_danas'; // pastikan sesuai nama tabel kamu

    protected $fillable = [
        'nama',
        'ktp',
        'no_rekening',
        'no_whatsapp',
        'kategori_pengajuan',
        'jumlah_dana_dibutuhkan',
        'jumlah_tanggungan_keluarga',
        'pekerjaan',
        'kondisi_kesehatan',
        'status_rumah',
        'ada_asuransi',
        'kebutuhan_mendesak',
        'lama_pengajuan',
        'penghasilan_bulanan',
        'punya_kendaraan',
        'status_pernikahan',
        'jumlah_anak',
        'status_korban',
        'bantuan_pemerintah',
    ];

    public function campaign()
    {
        return $this->hasOne(Campaign::class);
    }
}
