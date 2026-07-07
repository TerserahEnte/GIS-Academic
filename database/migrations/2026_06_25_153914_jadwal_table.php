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
        Schema::create('ruangan', function (Blueprint $table) {
            $table->string('kode_ruangan')->primary();
            $table->integer('id_node');
            $table->string('nama_ruangan');
            $table->text('deskripsi');

            $table->foreign('id_node')->references('id')->on('nodes')->onDelete('cascade');
        });

        Schema::create('dosen', function (Blueprint $table) {
            $table->string('kode_dosen')->primary();
            $table->string('nama_dosen');

        });

        Schema::create('jadwal', function (Blueprint $table) {
            $table->string('kode_jadwal')->primary();
            $table->string('kode_ruangan');
            $table->string('kode_dosen');
            $table->string('nama_matkul');
            $table->string('hari');
            $table->string('jam_mulai');
            $table->string('jam_selesai');

            $table->foreign('kode_ruangan')->references('kode_ruangan')->on('ruangan')->onDelete('cascade');
            $table->foreign('kode_dosen')->references('kode_dosen')->on('dosen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
        Schema::dropIfExists('ruangan');
        Schema::dropIfExists('dosen');
    }
};
