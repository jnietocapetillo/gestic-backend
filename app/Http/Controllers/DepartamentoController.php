<?php

namespace App\Http\Controllers;
use App\Models\departamento;
use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    // funcion que devuelve un listado de los departamentos
    function listado()
    {
        $departamentos = Departamento::all();

        return $departamentos;
    }

    function departamentoUsuario($id)
    {
        $nombreDepartamento = Departamento::find($id);

        return json_encode($nombreDepartamento->nombre);
    }
}
