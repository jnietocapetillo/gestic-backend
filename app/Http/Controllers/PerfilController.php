<?php

namespace App\Http\Controllers;
use App\Models\perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PerfilController extends Controller
{
    /** funcin que devuelve un listado con todos los perfiles */

    function perfiles()
    {
        $perfiles = Perfil::all();
        return $perfiles;
    }

    function perfilUsuario($id)
    {
        $nombrePerfil = Perfil::find($id);

        return json_encode($nombrePerfil->nombre);
    }

    function perfilNombre($nombre)
    {
        
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
}
