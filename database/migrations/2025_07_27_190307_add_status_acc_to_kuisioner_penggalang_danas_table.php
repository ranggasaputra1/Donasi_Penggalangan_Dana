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
    public function up(): void
{
    Schema::table('kuisioner_penggalang_danas', function (Blueprint $table) {
        $table->enum('status_acc', ['pending', 'layak', 'tidak_layak'])->default('pending');
    });
}

public function down(): void
{
    Schema::table('kuisioner_penggalang_danas', function (Blueprint $table) {
        $table->dropColumn('status_acc');
    });
}
};
