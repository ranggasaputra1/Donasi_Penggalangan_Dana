<?php
// database/migrations/xxxx_xx_xx_add_status_and_keterangan_to_riwayat_transaksi_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('riwayat_transaksi', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->after('nominal');
            $table->string('keterangan_admin')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('riwayat_transaksi', function (Blueprint $table) {
            $table->dropColumn(['status', 'keterangan_admin']);
        });
    }
};