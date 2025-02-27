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
        Schema::create('lapangans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->text('deskripsi');
            $table->decimal('harga', 10, 2);
            $table->text('fasilitas'); // Foreign key dari kategori_fasilitas
            $table->uuid('id_kategori');  // Foreign key dari kategori_olahragas
            $table->time('waktu');
            $table->date('tanggal');
            $table->text('alamat');
            $table->enum('status', ['Aktif', 'Tidak Aktif']);
            $table->text('gambar'); // Bisa menampung banyak gambar
            $table->timestamps();

            $table->foreign('id_kategori')->references('id')->on('kategori_olahragas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapangans');
    }
};
