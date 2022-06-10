<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ImageDashboardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gambar_dashboard', function (Blueprint $table) {
            $table->increments('id');
            $table->string('gambar')->nullable();
            $table->string('judul')->nullable();
            $table->string('caption')->nullable();
            $table->integer('id_jenis_kontent')->nullable();
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
