<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOngkirDataTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_transaksi', function (Blueprint $table) {
            $table->integer('id_kecamatan')->nullable();
            $table->integer('id_desa')->nullable();
            $table->decimal('ongkir', 20,0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_transaksi', function (Blueprint $table) {
            //
        });
    }
}
