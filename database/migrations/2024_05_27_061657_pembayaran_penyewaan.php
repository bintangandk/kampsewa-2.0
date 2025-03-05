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
        Schema::create('pembayaran_penyewaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_penyewaan');
            $table->foreign('id_penyewaan')->references('id')->on('penyewaan')->onDelete('cascade');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('jaminan_sewa')->nullable();
            $table->integer('jumlah_pembayaran')->nullable();
            $table->integer('kembalian_pembayaran')->default(0);
            $table->integer('biaya_admin')->nullable();
            $table->integer('kurang_pembayaran')->default(0);
            $table->integer('total_pembayaran')->nullable();
            $table->string('metode')->default('transfer')->nullable();
            $table->string('jenis_transaksi')->default('ambil ditempat');
            $table->string('status_pembayaran')->default('Belum lunas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_penyewaan');
    }
};
