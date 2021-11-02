<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\incidencia;

class IncidenciaController extends Controller
{
    /**
        funcion que lista todas las incidencias
     */
    function listado(){

        $listado = Incidencia::all();
        return $listado;
        //$json = json_decode($listado);
        //var_dump($json);

    }

    /**
        Detalle de una incidencia
     */

    function detalle($id)
    {
        $incidencia = Incidencia::find($id);
        $json = json_decode($incidencia);
        var_dump($json);

        
    }
    /**
        funcion que devuelve las incidencias de un usuario por POST
     */
    function incidencias_usuario($usuario){

        $incidencias = Incidencia::where('idusuario',$usuario)->get();
        $json = json_decode($incidencias);
        

    }

    /**
        función que agrega una nueva incidencia
   */
    function addIncidencia(Request $request)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        $nueva_incidencia = Incidencia::insert([
            'idusuario' => $datos->idusuario,
            'tecnico_asignado' => $datos ->tecnico_asignado,
            'fecha' => $datos->fecha,
            'prioridad' =>$datos->prioridad,
            'estado' => $datos-> estado,
            'titulo' => $datos->titulo,
            'ubicacion' =>$datos -> ubicacion,
            'descripcion' => $datos -> descripcion
        ]);

        $respuesta = [ 'estado' =>200, 'incidencia' => $nueva_incidencia];
        header('Content-Type: application/json');
        return json_encode($respuesta); 
    }
    /**
        funcion que actualiza una incidencia pasada por metodo PUT
     */
    function actualiza($incidencia){

    }

    /**
        funcion que elimina la incidencia por el metodo DELETE
     */
    function eliminar($incidencia){

    }

    function solicitud()
    {
        return view('solicitudDirector');
    }

    function datos( Request $request)
    {
        
    }
}
