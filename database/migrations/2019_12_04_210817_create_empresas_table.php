<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre')->nullable()->default('Mi empresa');
            $table->string('nit')->nullable()->default(0000000000);
            $table->string('telefono')->nullable()->default(0000000000);
            $table->string('direccion')->nullable()->default(0000000000);
            $table->string('email')->nullable()->default("example@miempresa.com");
            $table->longText('publicidad')->nullable();
            $table->string('img')->nullable()->default("logo.png");
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
        Schema::dropIfExists('empresas');
    }
}
