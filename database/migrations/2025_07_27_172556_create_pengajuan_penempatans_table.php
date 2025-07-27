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
        Schema::create('pengajuan_penempatans', function (Blueprint $table) {
            $table->id();
            // tahun ajaran

            $table->string('tahun_ajaran');
            $table->foreignId('siswa_id');
            $table->foreignId('perusahaan_id');
            $table->foreignId('guru_id')->nullable();
            $table->foreignId('instruktur_id')->nullable();
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->text('alasan')->nullable();
            $table->timestamp('tanggal_pengajuan')->useCurrent();
            $table->timestamp('tanggal_diterima')->nullable();
            $table->timestamp('tanggal_ditolak')->nullable();
            $table->string('file_pendukung')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_penempatans');
    }
};
