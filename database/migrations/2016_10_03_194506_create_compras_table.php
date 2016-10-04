<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('orden');
            $table->integer('clienteId');
            $table->integer('despachoId');
            $table->integer('subtotal');
            $table->integer('neto');
            $table->integer('iva');
            $table->integer('total');
            $table->integer('despacho');
            $table->integer('estado');
            $table->string('ip');
            $table->integer('tipo');
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
        Schema::dropIfExists('compras');
    }
}
