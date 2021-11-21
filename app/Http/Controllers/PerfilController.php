<?php

namespace App\Http\Controllers;
use App\Models\perfil;

class PerfilController extends Controller
{
    /** funcin que devuelve un listado con todos los perfiles */

    function perfiles()
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $perfiles = Perfil::all();
        return json_encode($perfiles);
    }

    function perfilUsuario($id)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $nombrePerfil = Perfil::find($id);

        return json_encode($nombrePerfil->nombre);
    }

    function perfilNombre($nombre)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $idPerfil = Perfil::where('nombre','like',$nombre)->first();

        if ($idPerfil != null)
        {
            $respuesta = [
                'estado' => 200,
                'id' => $idPerfil->id
            ];
        }
        else
        {
            $respuesta = [
                'estado' => 201,
                'id' => null
            ];
        }
        
        return json_encode($respuesta);
    }

    function imagenes($nombre)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $ruta = '/storage/app/'.$nombre;

        return response() ->$ruta;
        //return json_encode('http://gestic/storage/app/images/'.$nombre);
    }
}
