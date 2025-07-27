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
            $table->foreignId('category_id');
            $table->string('foto_campaign');
            $table->string('judul_campaign');
            $table->text('deskripsi_campaign');
            $table->foreignId('user_id');
            $table->date('tgl_mulai_campaign');
            $table->date('tgl_akhir_campaign');
            $table->integer('target_campaign');
            $table->integer('dana_terkumpul');
            $table->integer('status_campaign');
            $table->text('slug_campaign');
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
