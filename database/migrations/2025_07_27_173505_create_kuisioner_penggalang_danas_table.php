<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kuisioner_penggalang_danas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('ktp');
            $table->string('no_rekening');
            $table->string('no_whatsapp');

            $table->string('kategori_pengajuan');
            $table->decimal('jumlah_dana_dibutuhkan', 15, 2);
            $table->integer('jumlah_tanggungan_keluarga');
            $table->string('pekerjaan');
            $table->string('kondisi_kesehatan');
            $table->string('status_rumah');
            $table->boolean('ada_asuransi');
            $table->string('kebutuhan_mendesak');
            $table->string('lama_pengajuan');
            $table->decimal('penghasilan_bulanan', 15, 2);
            $table->boolean('punya_kendaraan');
            $table->string('status_pernikahan');
            $table->integer('jumlah_anak');
            $table->string('status_korban');
            $table->string('bantuan_pemerintah');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kuisioner_penggalang_danas');
    }
};
