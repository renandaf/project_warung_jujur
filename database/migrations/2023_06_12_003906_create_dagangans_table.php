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
        Schema::create('dagangans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('deskripsi')->nullable();
            $table->string('status');
            $table->string('catatan')->nullable();
            $table->bigInteger('harga');
            $table->string('gambar')->nullable();
            $table->string('qr')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('qr_code')->nullable();
            $table->string('jenis_dagangan');
            $table->string('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dagangans');
    }
};
