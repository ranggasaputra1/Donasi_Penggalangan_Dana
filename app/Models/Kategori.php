<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    public $table = "kategori";

    /**
     * Write code on Method
     *
     * @return response()
     */
    protected $fillable = [
        'nama_kategori',
    ];
    public function campaign()
    {
        return $this->hasMany(Campaign::class);
    }
}
