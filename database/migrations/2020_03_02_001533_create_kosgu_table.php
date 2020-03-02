<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKosguTable extends Migration
{
    public function up()
    {
        Schema::create('z_kosgu', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('kod_rashodov_id');
            $table->string('kod', 3);
            $table->string('name');
            $table->timestamps();

            $table->foreign('kod_rashodov_id')->references('id')->on('z_kod_rashodov');


        });
    }

    public function down()
    {
        Schema::dropIfExists('z_kosgu');
    }
}
