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
        Schema::create('balas_feedback', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_feedback')->nullable(false);
            $table->foreign('id_feedback')->references('id')->on('feedback')->onDelete('cascade');
            $table->unsignedBigInteger('id_user')->nullable(false);
            $table->foreign('id_user')->references('id')->on('users');
            $table->string('balasan', 255)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balas_feedback');
    }
};
