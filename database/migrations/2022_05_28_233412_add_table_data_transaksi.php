<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableDataTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_transaksi', function (Blueprint $table) {
            $table->increments('id_data_transaksi');
            $table->integer('id_transaksi');
            $table->char('nama')->nullable();
            $table->char('kota')->nullable();
            $table->char('alamat_lengkap')->nullable();
            $table->char('catatan')->nullable();
            $table->char('file')->nullable();
            $table->integer('nomor_hp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_transaksi');
    }
}
