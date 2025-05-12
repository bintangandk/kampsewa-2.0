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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('deskripsi');
            $table->string('bukti_laporan');
            $table->unsignedBigInteger('id_penyewaan');
            $table->foreign('id_penyewaan')->references('id')->on('penyewaan')->onDelete('cascade');
            $table->unsignedBigInteger('id_pelapor');
            $table->foreign('id_pelapor')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('id_terlapor');
            $table->foreign('id_terlapor')->references('id')->on('users')->onDelete('cascade');
            $table->enum('status', ['pending', 'tolak', 'terima'])->default('pending');






            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
