<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('idusuario');
            $table->string('password',255);
            $table->string('dni',9);
            $table->integer('idPerfil');
            $table->integer('idDepartamento');
            $table->string('nombre',25);
            $table->string('apellidos',100);
            $table->string('email',50);
            $table->string('avatar',255);
            $table->bigInteger('activo');
            $table->integer('movil',9);
            $table->string('domicilio',250);
            $table->string('localidad',250);
            $table->string('municipio',250);
            $table->string('codigo_postal',5);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            
            $table->foreign('idPerfil')->references('id')->on('perfil');
            $table->foreign('idDepartamento')->references('id')->on('departamento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
