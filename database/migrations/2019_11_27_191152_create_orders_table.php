<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('fecha_ingreso');
            $table->date('fecha_salida')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('cliente_id');
            $table->string('consecutivo')->nullable();
            $table->string('referencia')->nullable();
            $table->string('serial')->nullable();
            $table->unsignedBigInteger('accion_id')->nullable();
            $table->string('estado')->nullable();
            $table->longText('diagnostico')->nullable();
            $table->longText('observaciones')->nullable();
            $table->string('total');

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
        Schema::dropIfExists('orders');
    }
}
