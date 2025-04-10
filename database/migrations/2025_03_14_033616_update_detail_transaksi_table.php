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
        Schema::table('detail_transaksi', function (Blueprint $table) {
            // Hapus foreign key jika ada
            $table->dropForeign('detail_transaksi_total_harga_id_foreign');

            // Hapus kolom total_harga_id
            $table->dropColumn('total_harga_id');

            // Tambahkan kolom total_harga sebagai angka biasa
            $table->integer('total_harga')->after('jumlah_kue');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('detail_transaksi', function (Blueprint $table) {
            // Hapus kolom total_harga
            $table->dropColumn('total_harga');

            // Tambahkan kembali kolom total_harga_id sebagai foreign key ke transaksi.id
            $table->foreignId('total_harga_id')
                ->constrained('transaksi')
                ->onDelete('cascade')
                ->after('jumlah_kue');
        });
    }
};
