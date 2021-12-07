<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incidencias', function (Blueprint $table) {
            $table->increments('idincidencia');
            $table->integer('idusuario',3);
            $table->integer('tecnico_asignado',3);
            $table->dateTime('fecha');
            $table->integer('prioridad',1);
            $table->string('estado',10);
            $table->string('titulo',50);
            $table->string('ubicacion',40);
            $table->string('descripcion',300);
            $table->string('imagen',255);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
           
            $table->foreign('idusuario')->references('idusuario')->on('usuarios');
            $table->foreign('tecnico_asignado')->references('idusuario')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incidencias');
    }
}
