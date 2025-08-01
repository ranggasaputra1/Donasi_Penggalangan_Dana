<?php

// File: database/migrations/xxxx_xx_xx_xxxxxx_create_donations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('campaign_id')->constrained('campaigns')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('donor_name')->nullable();
            $table->string('donor_email')->nullable();
            $table->decimal('amount', 15, 2);
            $table->string('proof_of_payment')->nullable();
            $table->string('status')->default('pending'); // pending, completed, rejected
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
};