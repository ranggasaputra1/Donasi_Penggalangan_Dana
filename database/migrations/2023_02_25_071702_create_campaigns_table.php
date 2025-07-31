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
            $table->id();
            $table->foreignId('category_id')->constrained('kategoris')->onDelete('cascade'); // Menghubungkan kategori
            $table->string('foto_campaign');
            $table->string('judul_campaign');
            $table->text('deskripsi_campaign');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Menghubungkan user (admin)
            $table->foreignId('penggalang_dana_id')->constrained('kuisioner_penggalang_danas')->onDelete('cascade'); // Menyimpan ID penggalang dana
            $table->date('tgl_mulai_campaign');
            $table->date('tgl_akhir_campaign');
            $table->integer('target_campaign'); // Target dana yang ingin dikumpulkan
            $table->integer('dana_terkumpul')->default(0); // Dana yang terkumpul
            $table->integer('status_campaign'); // Status campaign: 0 - Pending, 1 - Disetujui, 2 - Ditolak
            $table->text('slug_campaign');

            // Menambahkan kolom-kolom terkait penggalang dana
            $table->decimal('jumlah_dana_dibutuhkan', 15, 2)->nullable();
            $table->integer('jumlah_tanggungan_keluarga')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('kondisi_kesehatan')->nullable();
            $table->string('kebutuhan_mendesak')->nullable();
            $table->string('lama_pengajuan')->nullable();
            $table->string('status_korban')->nullable();

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
