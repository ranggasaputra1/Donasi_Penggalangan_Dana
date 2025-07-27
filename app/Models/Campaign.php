<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_inisiator',
        'category_id',
        'foto_campaign',
        'judul_campaign',
        'deskripsi_campaign',
        'dana_terkumpul',
        'user_id',
        'tgl_mulai_campaign',
        'tgl_akhir_campaign',
        'target_campaign',
        'status_campaign',
        'slug_campaign',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Kategori::class);
    }
    public function Berita()
    {
        return $this->hasMany(Berita::class);
    }
}
