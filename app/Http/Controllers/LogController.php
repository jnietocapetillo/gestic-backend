<?php

namespace App\Http\Controllers;
use App\Models\log;
use Illuminate\Http\Request;
use App\Exports\logExport;
use Maatwebsite\Excel\Facades\Excel;

class LogController extends Controller
{
    /**
        listado de todos los log
     */
    function listado(){

        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $listado = log::all();

        $respuesta = [
            'resultado' => 200,
            'datos' => $listado
        ];
        
        return json_encode($respuesta);
        
    }

    /**
    * funcion que exporta a excel la lista de logs
     */
    function logsExcel()
    {
        
        return Excel::download(new LogExport, 'logs.xlsx');
      
    }
}
