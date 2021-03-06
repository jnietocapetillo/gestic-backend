<?php

namespace App\Http\Controllers;
use App\Models\perfil;
use App\Models\log;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use DateTime;

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

        $idPerfil = Perfil::where('nombre',$nombre)->first();

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

    function addPerfil(Request $request)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        $esta = Perfil::where('nombre', $datos->nombre)->first();

        if (is_null($esta))
        {
            try{
                DB::beginTransaction();
                $nuevoDepartamento = Perfil::insert(['nombre'=>$datos->nombre]);

                //log del sistema
                $fecha = new DateTime();
                $user = User::where('idPerfil',1)->first();
                log::insert([
                    'tipo_acceso' => 'marcado leido mensaje',
                    'idusuario' => $user->nombre.' '.$user->apellidos,
                    'fecha' => $fecha
                ]);
                DB::commit();
            }catch(Exception $e){
                DB::rollBack();
            }
            
            if ($nuevoDepartamento)
            {
                $respuesta = 200;
            }
            else    
            {
                $respuesta = 201;
            }
        }
        else $respuesta=202;

        return json_encode($respuesta);
    }
}
