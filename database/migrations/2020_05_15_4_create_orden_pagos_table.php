<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenPagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden_pago', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('consecutivo')->nullable();
            $table->date('fecha_pago_ordinario');
            $table->date('fecha_pago_extra');
            $table->bigInteger('subtotal');
            $table->bigInteger('descuento');
            $table->string('periodo',8);
            $table->string('observaciones', 250)->nullable();
            $table->bigInteger('id_estudiante')->unsigned();
            $table->foreign('id_estudiante')->references('id')->on('estudiantes');
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
        Schema::dropIfExists('orden_pago');
    }
}
