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
            $table->string('desc');
            $table->string('status');
            $table->float('harga');
            $table->string('gambar');
            $table->string('qr');
            $table->string('pemilik');
            $table->string('qr_code');
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
