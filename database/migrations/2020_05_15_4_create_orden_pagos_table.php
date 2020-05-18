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
            $table->bigInteger('consecutivo');
            $table->date('fecha_generada');
            $table->date('fecha_vencimiento');
            $table->bigInteger('subtotal');
            $table->bigInteger('descuento');
            $table->bigInteger('total');
            $table->string('observaciones', 250);
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
