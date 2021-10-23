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
        $json = json_decode($listado);
        var_dump($listado);
    }
}
