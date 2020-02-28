<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMPISTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mpi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shortname', 50)->unique();
            $table->string('name')->unique();
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
        Schema::dropIfExists('mpi');
    }
}
