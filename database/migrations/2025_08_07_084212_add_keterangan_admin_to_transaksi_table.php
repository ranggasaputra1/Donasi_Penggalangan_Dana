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
        Schema::table('transaksi', function (Blueprint $table) {
            // Menambahkan kolom 'keterangan_admin' yang bisa kosong
            $table->string('keterangan_admin')->nullable()->after('status_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Menghapus kolom 'keterangan_admin' jika migrasi di-rollback
            $table->dropColumn('keterangan_admin');
        });
    }
};