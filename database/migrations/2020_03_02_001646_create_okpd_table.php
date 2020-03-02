<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOkpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_okpd', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kod_rashodov_id');
            $table->string('kod', 15)->unique();
            $table->string('name');
            $table->timestamps();

            $table->foreign('kod_rashodov_id')->references('id')->on('z_kod_rashodov');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_okpd');
    }
}
