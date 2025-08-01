<?php

// File: database/migrations/xxxx_xx_xx_xxxxxx_create_riwayat_transaksi_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('riwayat_transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->unique()->constrained('transaksi')->onDelete('cascade');
            $table->foreignId('campaign_id');
            $table->foreignId('user_id')->nullable();
            $table->string('nama_donatur');
            $table->decimal('nominal', 15, 2);
            $table->datetime('tgl_konfirmasi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('riwayat_transaksi');
    }
};