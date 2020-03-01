<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOBASSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year', 4);
            $table->unsignedBigInteger('mpi_id');
            $table->unsignedBigInteger('tru_id');
            $table->double('sum', 12, 2)->default('0');

            $table->timestamps();

            $table->foreign('mpi_id')->references('id')->on('mpi');
            $table->foreign('tru_id')->references('id')->on('tru');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obas');
    }
}
