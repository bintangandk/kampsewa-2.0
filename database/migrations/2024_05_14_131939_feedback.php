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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable(false);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->text('deskripsi')->nullable(true);
            $table->enum('kriteria', ['Sangat Baik', 'Baik', 'Cukup', 'Kurang', 'Sangat Kurang'])->nullable(false);
            $table->enum('status', ['Dibalas', 'Belum Dibalas'])->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
