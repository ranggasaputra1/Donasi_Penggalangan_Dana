<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
        'kategori_pengajuan',
        'jumlah_dana_dibutuhkan',
        'jumlah_tanggungan_keluarga',
        'pekerjaan',
        'kondisi_kesehatan',
        'kebutuhan_mendesak',
        'lama_pengajuan',
        'status_korban',
        'no_rekening',
        'no_whatsapp',
        'no_rekening_admin',
        'no_whatsapp_admin',
    ];
    
    // Tambahkan properti ini untuk mengonversi kolom tanggal menjadi objek Carbon secara otomatis
    protected $casts = [
        'tgl_mulai_campaign' => 'datetime',
        'tgl_akhir_campaign' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'category_id');
    }

    public function berita(): HasMany
    {
        return $this->hasMany(Berita::class);
    }

    public function kuisioner(): BelongsTo
    {
        return $this->belongsTo(KuisionerPenggalangDana::class, 'penggalang_dana_id');
    }
}