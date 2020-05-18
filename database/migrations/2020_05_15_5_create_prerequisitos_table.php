<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrerequisitosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prerequisitos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_materia')->unsigned();
            $table->bigInteger('id_programa')->unsigned();
            $table->bigInteger('prerequsito')->unsigned();
            $table->foreign('id_materia')->references('id')->on('materias');
            $table->foreign('id_programa')->references('id')->on('programas');
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
        Schema::dropIfExists('prerequisitos');
    }
}
