<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('arsips', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('nomor_risalah')->unique();
            $table->string('pemohon');
            $table->enum('jenis_lelang', ['jenis1', 'jenis2']);
            $table->text('uraian_barang');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsips');
    }
};
