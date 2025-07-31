<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'foto_campaign',
        'judul_campaign',
        'deskripsi_campaign',
        'dana_terkumpul',
        'user_id',
        'penggalang_dana_id',
        'tgl_mulai_campaign',
        'tgl_akhir_campaign',
        'target_campaign',
        'status_campaign',
        'slug_campaign',
        'jumlah_dana_dibutuhkan',
        'jumlah_tanggungan_keluarga',
        'pekerjaan',
        'kondisi_kesehatan',
        'kebutuhan_mendesak',
        'lama_pengajuan',
        'status_korban',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Kategori::class, 'category_id');
    }

    public function berita()
    {
        return $this->hasMany(Berita::class);
    }

    // Relasi dengan KuisionerPenggalangDana (menyimpan informasi penggalang dana)
    public function kuisioner()
    {
        return $this->belongsTo(KuisionerPenggalangDana::class, 'penggalang_dana_id');
    }
}
