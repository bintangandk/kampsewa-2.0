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
        Schema::create('detail_variant_produk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_variant_produk');
            $table->foreign('id_variant_produk')->references('id')->on('variant_produk')->onDelete('cascade');
            $table->string('ukuran')->default('Belum di isi');
            $table->integer('stok')->default(0);
            $table->integer('harga_sewa')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_variant_produk');
    }
};
