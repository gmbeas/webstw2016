<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('compraid');
            $table->integer('orden');
            $table->integer('monto');
            $table->integer('numerotarjeta');
            $table->dateTime('fechahora');
            $table->string('tipotarjeta');
            $table->string('mac');
            $table->string('codigoautorizacion');
            $table->integer('cuotas');
            $table->date('fechaexpiracion');
            $table->date('fechacontable');
            $table->string('codigo');
            $table->string('respuesta');
            $table->integer('estado');
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
        Schema::dropIfExists('pagos');
    }
}
