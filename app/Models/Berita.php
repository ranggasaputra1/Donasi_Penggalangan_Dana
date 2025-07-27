<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    public $table = "berita";

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
