<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifikasiAkun extends Model
{
    use HasFactory;
    public $table = "verifikasi_akun";

    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'user_id',
        'nomor_ktp',
        'nama_ktp',
        'tanggal_lahir',
        'alamat',
        'foto_ktp',
        'status_verifikasi',
    ];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
