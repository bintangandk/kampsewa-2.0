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
        Schema::create('detail_iklan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_iklan')->nullable(false);
            $table->foreign('id_iklan')->references('id')->on('iklan')->onDelete('cascade');
            $table->date('tanggal_mulai')->nullable(false);
            $table->date('tanggal_akhir')->nullable(false);
            $table->integer('harga_iklan')->nullable(false);
            $table->string('status_iklan')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_iklan');
    }
};
