<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\incidencia;
use App\Models\Mensaje;
use App\Models\log;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use DateTime;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\incidenciasExport;

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
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

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

        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

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

        $desc = strip_tags($datos->descripcion);

        try{
            DB::beginTransaction();

            $nueva_incidencia = Incidencia::insert([
            'idusuario' => $datos->idusuario,
            'tecnico_asignado' => $datos ->tecnico_asignado,
            'fecha' => $datos->fecha,
            'prioridad' =>$datos->prioridad,
            'estado' => $datos-> estado,
            'titulo' => $datos->titulo,
            'ubicacion' =>$datos ->departamento,
            'descripcion' => $desc,
            'imagen' => $datos -> imagen
            ]);

            //log del sistema
            $fecha = new DateTime();
            $usuario = User::where('idusuario',$datos->idusuario)->first();
            log::insert([
                'tipo_acceso' => 'add incidencia',
                'idusuario' => $usuario->nombre.' '.$usuario->apellidos,
                'fecha' => $fecha
            ]);

            DB::commit();
            if ($nueva_incidencia)
            {
                $incidencia_creada = Incidencia::max('idincidencia');
                $incidencia = Incidencia::where('idincidencia',$incidencia_creada)->first();
                $respuesta = [ 'estado' =>200, 'incidencia' => $incidencia];
            }
        }catch(Exception $e){
            DB::rollBack();
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

        $ruta = 'D:/gest-laravel/gestic/storage/app/public/'.$nombreArchivo;

        file_put_contents($ruta,$archivo);

        //actualizamos el campo imagen en la incidencia
        try{
            DB::beginTransaction();
            $incidencia_creada = Incidencia::max('idincidencia');

            $incidencia = Incidencia::where('idincidencia',$incidencia_creada)->update(['imagen'=>$nombreArchivo]);

            //log del sistema
            $fecha = new DateTime();
            $usuario = User::where('idusuario',$incidencia->idusuario)->first();
            log::insert([
                'tipo_acceso' => 'update incidencia',
                'idusuario' => $usuario->nombre.' '.$usuario->apellidos,
                'fecha' => $fecha
            ]);
            DB::commit();
            if ($incidencia)
                $respuesta = 200;
        }catch(Exception $e){
            $respuesta = 201;  
            DB::rollBack();
        }     
        
        header('Content-Type: application/json');
        return json_encode($respuesta); 

    }

    /**
        funcion que devuelve el id del tecnico asignado a una incidencia dada por id
     */
    function tecnicoIncidencia($id)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $idTecnico = Incidencia::find($id);

        if ($idTecnico != null)
        {
            $respuesta = 200;
            $datos = $idTecnico->tecnico_asignado;
        }
        else
        {
            $respuesta = 201;
            $datos = null;
        }

        $resultado = ['resultado'=>$respuesta, 'datos'=>$datos];

        header('Content-Type: application/json');
        return json_encode($resultado); 

    }

    /**
        funcion que devuelve el idusuario de una incidencia a traves de su idincidencia
     */
    function idUsuarioIncidencia($id)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $IDusuario = Incidencia::find($id);

        if ($IDusuario == null)
        {
            $respuesta = [
                'estado' => 201,
                'datos' => null
            ];
        }
        else
        {
            $respuesta = [
                'estado' => 200,
                'datos' => $IDusuario
            ];
        }

        header('Content-Type: application/json');
        return json_encode($respuesta); 
    }

    /**
        funcion que asigna un tecnico y una prioridad a una incidencia
     */
    function asignarTecnicoPrioridad(Request $request)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $json = file_get_contents('php://input'); //recibimos el json de angular
        $parametros = json_decode($json);// decodifica el json y lo guarda en paramentros
        try{
            DB::beginTransaction();
            $actualizar = Incidencia::where('idincidencia', $parametros->id)->update(['prioridad'=>$parametros->prioridad, 'tecnico_asignado'=>$parametros->tecnico]);

            //log del sistema
            $fecha = new DateTime();
            $usuario = User::where('idusuario',1)->first();
            log::insert([
                'tipo_acceso' => 'asignar tecnico/prioridad',
                'idusuario' => $usuario->nombre.' '.$usuario->apellidos,
                'fecha' => $fecha
            ]);
            DB::commit();
            if ($actualizar)
            {
                $respuesta = 200;
            }
        }catch(Exception $e){
            $respuesta = 201;
            DB::rollBack();
        }
        
        return json_encode($respuesta);

    }

    /**
        funcion que actualiza una incidencia pasada por metodo PUT
     */
    function updateIncidencia(Request $request){

        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $json = file_get_contents('php://input'); //recibimos el json de angular
        $parametros = json_decode($json);// decodifica el json y lo guarda en paramentros

        $incidencia = Incidencia::where('idincidencia',$parametros->idincidencia)->update([
            'prioridad' => $parametros->prioridad,
            'estado' => $parametros->estado,
            'descripcion' => $parametros->descripcion
        ]);

        if ($incidencia)
        {
            $respuesta = 200;
        }
        else $respuesta = 201;

        return json_encode($respuesta);
    }

    /**
        funcion que elimina la incidencia por el metodo DELETE
     */
    function deleteIncidencia($id){

        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        //debemos borrar las incidencias y mensajes asociados a este usuario
        try{
            DB::beginTransaction();
            $mensajes = Mensaje::where('idincidencia',$id)->delete();
            $incidencia = Incidencia::where('idincidencia',$id)->delete();
            DB::commit();
            $respuesta = 200;
        }catch(Exception $e){
            DB::rollBack();
            $respuesta = 201;
        }

        return json_encode($respuesta);
    }

    function incidenciasTecnico(Request $request)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $json = file_get_contents('php://input'); //recibimos el json de angular
        $parametros = json_decode($json);// decodifica el json y lo guarda en paramentros

        $incidencias_tecnicos = Incidencia::where('tecnico_asignado',$parametros)->get();

        if ($incidencias_tecnicos == null)
        {
            $estado = 201;
            $datos = null;
        }
        else
        {
            $estado = 200;
            $datos = $incidencias_tecnicos;
        }

        $respuesta = [
            'estado' => $estado,
            'datos' => $datos
        ];

        return json_encode($respuesta);
    }

    /**
    * funcion que exporta a excel la lista de incidencias
     */
    function incidenciasExcel()
    {
        
        return Excel::download(new IncidenciasExport, 'incidencias.xlsx');
      
    }
}
