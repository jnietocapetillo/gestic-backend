<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\incidencia;
use Error;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Facades\Storage;
use PhpParser\JsonDecoder;

class IncidenciaController extends Controller
{
    /**
        funcion que lista todas las incidencias
     */
    function listado(){

        $listado = Incidencia::all();
        return $listado;

    }

    /**
        Detalle de una incidencia
     */

    function detalle($id)
    {
        $incidencia = Incidencia::find($id);

        if ($incidencia == null)
        {
            $devolver = [
                'mensaje' => 201,
                'datos' => null
            ];
        }
        else
        {
            $devolver = [
                'mensaje' => 200,
                'datos' => $incidencia
            ];
        }
        return json_encode($devolver);
        
    }
    /**
        funcion que devuelve las incidencias de un usuario por GET
     */
    function incidenciasUsuario($id){

        $incidencias = Incidencia::where('idusuario',$id)->get();
        return json_encode($incidencias);
        

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
            'ubicacion' =>$datos ->departamento,
            'descripcion' => $datos -> descripcion,
            'imagen' => $datos -> imagen
        ]);
        
        if ($nueva_incidencia)
        {
            $incidencia_creada = Incidencia::max('idincidencia');
            $incidencia = Incidencia::where('idincidencia',$incidencia_creada)->first();
            $respuesta = [ 'estado' =>200, 'incidencia' => $incidencia];
        }
        else
        {
            $respuesta = [ 'estado' =>201, 'incidencia' => null];
        }
            header('Content-Type: application/json');
            return json_encode($respuesta); 
    }

    /**
        funcion que sube una imagen de una incidencia
     */
    function incidenciaImagen(Request $request)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");
       
        $json = file_get_contents('php://input'); //recibimos el json de angular
        $parametros = json_decode($json);// decodifica el json y lo guarda en paramentros

        $nombre = $parametros->nombre;
        $nombreArchivo = $parametros->nombreArchivo;
        $archivo = $parametros->base64textString;
        $archivo = base64_decode($archivo);

        $ruta = 'D:/gest-laravel/gestic/storage/app/images/'.$nombreArchivo;

        file_put_contents($ruta,$archivo);

        //actualizamos el campo imagen en la incidencia

        $incidencia_creada = Incidencia::max('idincidencia');
        $incidencia = Incidencia::where('idincidencia',$incidencia_creada)->update(['imagen'=>$ruta]);
        
        if ($incidencia)
            $respuesta = 200;
        else
            $respuesta = 201;    
        
        header('Content-Type: application/json');
        return json_encode($incidencia); 

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

    function prueba()
    {
        
    }
}
