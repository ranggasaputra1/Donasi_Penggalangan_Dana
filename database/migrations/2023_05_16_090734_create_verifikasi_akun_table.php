<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verifikasi_akun', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->string('nomor_ktp')->unique();
            $table->string('nama_ktp');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('foto_ktp');
            $table->integer('status_verifikasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verifikasi_akun');
    }
};
