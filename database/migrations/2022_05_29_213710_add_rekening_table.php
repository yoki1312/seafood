<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRekeningTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('master_contact_us', function (Blueprint $table) {
            $table->string('no_rekening')->nullable();
            $table->string('nama_rekening')->nullable();
            $table->string('nama_bank')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_contact_us', function (Blueprint $table) {
            //
        });
    }
}
