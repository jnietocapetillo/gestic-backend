<?php

namespace App\Http\Controllers;
use App\Models\departamento;
use App\Models\log;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use DateTime;

class DepartamentoController extends Controller
{
    // funcion que devuelve un listado de los departamentos
    function listado()
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $departamentos = Departamento::all();

        return json_encode($departamentos);
    }

    function departamentoUsuario($id)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $nombreDepartamento = Departamento::find($id);

        return json_encode($nombreDepartamento->nombre);
    }

    function addDepartamento(Request $request)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        $esta = departamento::where('nombre',$datos->nombre)->first();

        if (is_null($esta))
        {        
            try{
                DB::beginTransaction();
                
                $nuevoDepartamento = departamento::insert(['nombre'=>$datos->nombre]);
                //log del sistema
                $fecha = new DateTime();
                $usuAdmin = User::where('idPerfil',1)->first();

                log::insert([
                    'tipo_acceso' => 'add departamento',
                    'idusuario' => $usuAdmin->nombre.' '.$usuAdmin->apellidos,
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
        else $respuesta = 202;

        return json_encode($respuesta);
    }
}
