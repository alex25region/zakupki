<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudjet extends Migration
{
    public function up()
    {
        Schema::create('budjet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('kod_rashodov', 3);
            $table->string('fullkod_rashodov', 50);
            $table->string('year', 4);
            $table->double('sum', 12, 2)->default('0');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('budjet');
    }
}
