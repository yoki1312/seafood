<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_pengiriman', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kabupaten')->nullable();
            $table->integer('id_kecamatan')->nullable();
            $table->integer('id_desa')->nullable();
            $table->decimal('harga_meter')->nullable();
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
        Schema::dropIfExists('setting_pengiriman');
    }
}
