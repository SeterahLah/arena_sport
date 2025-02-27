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
        Schema::create('produks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('nama');
            $table->text('deskripsi');
            $table->text('alamat');
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            $table->integer('berat');
            $table->enum('kategori',['Pakaian', 'Alat', 'Makanan Atau Kesehatan']);
            $table->text('gambar'); // Menyimpan JSON untuk banyak gambar
            $table->enum('status',['Aktif', 'Tidak Aktif', 'Stok Habis']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
