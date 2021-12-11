<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mensaje;
use App\Models\log;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use DateTime;

class MensajeController extends Controller
{
    /**
        Funcion que agrega un nuevo mensaje 
     */
    function addMensaje( Request $request )
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $json = file_get_contents('php://input');
        $datos = json_decode($json);
        $desc = strip_tags($datos->descripcion);
        $fecha = Date("Y-m-d H:i:s");
        try{
            DB::beginTransaction();
            $nuevo_mensaje = Mensaje::insert([
            'idusuario_receptor'=>$datos->idusuario_receptor,
            'idusuario_origen' =>$datos->idusuario_origen,
            'idincidencia' => $datos-> idincidencia,
            'fecha' => $fecha,
            'descripcion' => $desc,
            'leido' => $datos->leido,
            'imagen' => $datos -> imagen
            ]);

            //log del sistema
            $fecha = new DateTime();
            $usuario = User::where('idusuario',$datos->idusuario_origen)->first();
            log::insert([
                    'tipo_acceso' => 'add mensaje',
                    'idusuario' => $usuario->nombre.' '.$usuario->apellidos,
                    'fecha' => $fecha
            ]);
            DB::commit();

            if ($nuevo_mensaje)
            {
                $respuesta = 200;
                
            }
        }catch(Exception $e){
            $respuesta = 201;
            DB::rollBack();
        }
            header('Content-Type: application/json');
            return json_encode($respuesta); 
    }

    /**
        funcion que sube una imagen de una incidencia
     */
    function mensajeImagen(Request $request)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");
       
        $json = file_get_contents('php://input'); //recibimos el json de angular
        $parametros = json_decode($json);// decodifica el json y lo guarda en paramentros

        $nombre = $parametros->nombre;
        $nombreArchivo = $parametros->nombreArchivo;
        $archivo = $parametros->base64textString;
        $archivo = base64_decode($archivo);

        $ruta = 'storage/'.$nombreArchivo;

        file_put_contents($ruta,$archivo);

        //actualizamos el campo imagen en la incidencia

        try{
            DB::beginTransaction();
            $mensaje_creado = Mensaje::max('idmensaje');
            $mensaje = Mensaje::where('idmensaje',$mensaje_creado)->update(['imagen'=>$nombreArchivo]);

            //log del sistema
            $fecha = new DateTime();
            $usuario = User::where('idusuario',$mensaje->idusuario_origen)->first();
            log::insert([
                    'tipo_acceso' => 'update mensaje',
                    'idusuario' => $usuario->nombre.' '.$usuario->apellidos,
                    'fecha' => $fecha
            ]);
            DB::commit();
            if ($mensaje)
                $respuesta = 200;
        }catch(Exception $e){
            $respuesta = 201;  
            DB::rollBack();
        }
        
        header('Content-Type: application/json');
        return json_encode($respuesta); 

    }

    /**
        funcion que envia los mensajes de un usuario
     */
    function mensajesUsuarios($dato)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $mensajes = Mensaje::where('idusuario_receptor',$dato)->get();

        if ($mensajes == null)
        {
            $devolver = [
                'mensaje' => 202,
                'datos' => null
            ];
        }
        else
        {
            $devolver = [
                'mensaje' => 200,
                'datos' => $mensajes
            ];
        }
        return json_encode($devolver);
    }

    /**
        funcion que envia una lista de todos los mensajes no leidos de un usuario especifico
     */
    function mensajesNoLeidosUsuarios($id)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $mensajes = Mensaje::where([['idusuario_receptor', $id], ['leido', 0]])->get();
        
        if ($mensajes == null)
        {
            $devolver = [
                'mensaje' => 202,
                'datos' => null
            ];
        }
        else
        {
            $devolver = [
                'mensaje' => 200,
                'datos' => $mensajes
            ];
        }
        return json_encode($devolver);
    }

    /**
        funcion que devuelve un listado de mensajes que estan asociados a un incidencia dada por id
     */
    function mensajesIncidencias($id)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $mensajes = Mensaje::where('idincidencia',$id)->get();
        if ($mensajes == null)
        {
            $devolver = [
                'estado' => 202,
                'datos' => null
            ];
        }
        else
        {
            $devolver = [
                'estado' => 200,
                'datos' => $mensajes
            ];
        }

        return json_encode($devolver);
    }

    /**
        funcion que marca como leido un mensaje a traves de su id
     */
    function mensajeLeido($id)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        try{
            DB::beginTransaction();
            $updateMensaje = Mensaje::where('idmensaje',$id)->update(['leido'=>1]);
            $mensajeUsuario = Mensaje::where('idmensaje',$id)->first();

            //log del sistema
            $fecha = new DateTime();
            $usuario = User::where('idusuario',$mensajeUsuario->idusuario_origen)->first();
            log::insert([
                'tipo_acceso' => 'marcado leido mensaje',
                'idusuario' => $usuario->nombre.' '.$usuario->apellidos,
                'fecha' => $fecha
            ]);
                $resultado = 200;
            DB::commit();
        
        }catch(Exception $e){
            $resultado = 201;
            DB::rollBack();
        }
        return json_encode($resultado);
    }

    /**
        devuelve los datos de un mensaje con el id dado
     */
    function detalleMensaje($id)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $mensaje = Mensaje::find($id);

        if (!is_null($mensaje))
        {
            $response = [
                'estado' => 200,
                'datos' => $mensaje
            ];
        }
        else
        {
            $response = [
                'estado' => 201,
                'datos' => null
            ];
        }

        return json_encode($response);
    }

    function actualizarLeidoPorIncidencia($id)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        try{
            DB::beginTransaction();
            $marcarLeido = Mensaje::where('idincidencia',$id)->update(['leido' => 1]);
            
            //log del sistema
            $fecha = new DateTime();
            $usuario = User::where('idusuario',$marcarLeido->idusuario_origen)->first();
            log::insert([
                'tipo_acceso' => 'marcado leido mensaje',
                'idusuario' => $usuario->nombre.' '.$usuario->apellidos,
                'fecha' => $fecha
            ]);
            if ($marcarLeido)
            {
                $respuesta = 200;
            }
            DB::commit();
        }catch (Exception $e){
            $respuesta = 201;
            DB::rollBack();
        }

        return json_encode($respuesta);
    }
}
