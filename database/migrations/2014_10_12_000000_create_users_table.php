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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable(false);
            $table->tinyInteger('type')->default(0);
            $table->string('nomor_telephone')->nullable(false);
            $table->date('tanggal_lahir')->nullable();
            $table->string('foto')->nullable()->default('Belum Di isi');
            $table->string('status')->nullable();
            $table->string('background')->nullable()->default('Belum Di isi');
            $table->string('jenis_kelamin')->nullable();
            $table->timestamp('time_login')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('name_store')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
