<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->increments('idmensaje');
            $table->integer('idusuario_receptor',3);
            $table->integer('idusuario_origen',3);
            $table->integer('idincidencia',3);
            $table->dateTime('fecha');
            $table->string('descripcion',500);
            $table->integer('leido',1);
            $table->string('imagen',50);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            
            $table->foreign('idusuario_receptor')->references('idusuario')->on('usuarios');
            $table->foreign('idusuario_origen')->references('idusuario')->on('usuarios');
            $table->foreign('idincidencia')->references('idincidencia')->on('incidencias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensajes');
    }
}
