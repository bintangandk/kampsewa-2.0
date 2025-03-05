<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran_iklan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_iklan');
            $table->foreign('id_iklan')->references('id')->on('iklan')->onDelete('cascade');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('metode_bayar')->default('transfer');
            $table->integer('total_bayar')->nullable(false);
            $table->string('status_bayar')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_iklan');
    }
};
