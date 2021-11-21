<?php

namespace App\Http\Controllers;
use App\Models\departamento;

class DepartamentoController extends Controller
{
    // funcion que devuelve un listado de los departamentos
    function listado()
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $departamentos = Departamento::all();

        return json_encode($departamentos);
    }

    function departamentoUsuario($id)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $nombreDepartamento = Departamento::find($id);

        return json_encode($nombreDepartamento->nombre);
    }
}
