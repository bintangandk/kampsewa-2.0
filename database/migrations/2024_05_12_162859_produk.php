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
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user')->nullable(false);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->string('nama', 100)->nullable(false);
            $table->text('deskripsi')->nullable(false);
            $table->enum('status', ['Tersedia', 'Tidak Tersedia'])->nullable(false);
            $table->string('kategori', 100)->nullable(false);
            $table->string('foto_depan', 255)->nullable();
            $table->string('foto_belakang', 255)->default('Belum di isi');
            $table->string('foto_kiri', 255)->default('Belum di isi');
            $table->string('foto_kanan', 255)->default('Belum di isi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
