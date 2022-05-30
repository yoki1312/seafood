<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTableDataSupplier extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_supplier', function (Blueprint $table) {
            $table->increments('id_data_supplier');
            $table->integer('id_supplier');
            $table->string('nama_bank')->nullable();
            $table->string('no_rek')->nullable();
            $table->string('no_wa')->nullable();
            $table->string('kota')->nullable();
            $table->string('alamat_lengkap')->nullable();
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
        //
    }
}
