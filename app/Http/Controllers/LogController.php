<?php

namespace App\Http\Controllers;
use App\Models\log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
        listado de todos los log
     */
    function listado(){

        $listado = log::all();

        $respuesta = [
            'resultado' => 200,
            'datos' => $listado
        ];
        
        return json_encode($respuesta);
        
    }
}
