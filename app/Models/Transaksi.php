<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    public $table = "transaksi";
    protected $fillable = [
        'id',
        'nama',
        'user_id',
        'campaign_id',
        'nominal_transaksi',
        'tgl_transaksi',
        'keterangan',
        'status_transaksi',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
