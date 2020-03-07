<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPITable extends Migration
{
    public function up()
    {
        Schema::create('z_mpi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year', 4);
            $table->string('shortname', 50);
            $table->string('name');
            $table->string('kod', 50)->unique();
            $table->timestamps();

            $table->index(['name', 'kod']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('z_mpi');
    }
}
