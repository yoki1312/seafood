<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnHargaDlSettingPengirimanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('setting_pengiriman', function (Blueprint $table) {
            $table->decimal("harga_dalam")->nullable();
            $table->decimal("harga_luar")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('setting_pengiriman', function (Blueprint $table) {
            //
        });
    }
}
