<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOBASTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('z_obas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('year', 4);
            $table->unsignedBigInteger('mpi_id');
            $table->unsignedBigInteger('tru_id');
            $table->unsignedBigInteger('kosgu_id');
            $table->unsignedBigInteger('okpd_id');
            $table->double('sum', 20, 2)->default('0');

            $table->timestamps();

            $table->foreign('mpi_id')->references('id')->on('z_mpi');
            $table->foreign('tru_id')->references('id')->on('z_tru');
            $table->foreign('kosgu_id')->references('id')->on('z_kosgu');
            $table->foreign('okpd_id')->references('id')->on('z_okpd');

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
