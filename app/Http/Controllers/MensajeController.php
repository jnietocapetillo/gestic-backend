<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\mensaje;

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
        
        $fecha = Date("Y-m-d H:i:s");

        $nuevo_mensaje = Mensaje::insert([
            'idusuario_receptor'=>$datos->idusuario_receptor,
            'idusuario_origen' =>$datos->idusuario_origen,
            'idincidencia' => $datos-> idincidencia,
            'fecha' => $fecha,
            'descripcion' => $datos -> descripcion,
            'leido' => $datos->leido,
            'imagen' => $datos -> imagen
        ]);


        if ($nuevo_mensaje)
        {
            $respuesta = 200;
            
        }
        else
        {
            $respuesta = 201;
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

        $mensaje_creado = Mensaje::max('idmensaje');
        $mensaje = Mensaje::where('idmensaje',$mensaje_creado)->update(['imagen'=>$nombreArchivo]);
        
        if ($mensaje)
            $respuesta = 200;
        else
            $respuesta = 201;    
        
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
    function mensajesNoLeidosUsuarios($dato)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $mensajes = Mensaje::where('idusuario_receptor',$dato)->where('leido',0)->get();

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

        $updateMensaje = Mensaje::where('idmensaje',$id)->update(['leido'=>1]);

        if ($updateMensaje)
            $resultado = 200;
        else    
            $resultado = 201;

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
}
