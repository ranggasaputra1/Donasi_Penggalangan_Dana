<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'tgl_terbit',
        'user_id',
        'gambar',
        'isi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
