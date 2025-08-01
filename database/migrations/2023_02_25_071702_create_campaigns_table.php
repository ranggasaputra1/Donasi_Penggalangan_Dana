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
        Schema::create('campaigns', function (Blueprint $table) {
    $table->id(); // Auto incrementing unsigned big integer untuk primary key
    $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('penggalang_dana_id')->constrained('kuisioner_penggalang_danas')->onDelete('cascade');
    $table->string('foto_campaign');
    $table->string('judul_campaign');
    $table->text('deskripsi_campaign');
    $table->decimal('dana_terkumpul', 15, 2)->default(0);
    $table->timestamp('tgl_mulai_campaign');
    $table->timestamp('tgl_akhir_campaign');
    $table->decimal('target_campaign', 15, 2);
    $table->integer('status_campaign')->default(0);
    $table->string('slug_campaign')->unique();
    $table->string('kategori_pengajuan'); // Simpan kategori_pengajuan dari kuisioner_penggalang_danas
    $table->decimal('jumlah_dana_dibutuhkan', 15, 2);
    $table->integer('jumlah_tanggungan_keluarga');
    $table->string('pekerjaan');
    $table->string('kondisi_kesehatan');
    $table->string('kebutuhan_mendesak');
    $table->string('lama_pengajuan');
    $table->string('status_korban');
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
        Schema::dropIfExists('campaigns');
    }
};
