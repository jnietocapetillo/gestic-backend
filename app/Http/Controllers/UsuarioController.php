<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use PHPUnit\Util\Json;

class UsuarioController extends Controller
{
    /**
        Comprobamos si el correo y la contraseña corresponden a un usuario
     */

    function login(Request $request)
    {
        $datos = json_decode($request);
        return ($request);
        $usuario = User::where('email',$request->email)->where('password',$request->password)->first();
        
        $usuario_json = json_decode($usuario);
        
        if (empty($usuario))
        {
            $resultado=201;
            $mensaje=$usuario;
        }
        else
        {
            $resultado = 200;
            $mensaje = $usuario_json;
        } 

        $response = [
            'estado'=>$resultado,
            'usuario' => $mensaje
        ];
        
        return ($response);
    }

    function vistaLogin()
    {
        return view('pruebaPost');
    }
    /**
        funcion que nos da todas los usuario de la base de datos
     */
    function listado(){
        $listado = User::all();
        return($listado);
    }

    /**
        funcion que devuelve un usuario especificado por el id
     */

    function detalle($id){
        $detalle = User::find($id);
        $json = json_decode($detalle);
        return($json);
    }

    /**
        funcion que actualiza los datos enviados por PUT de un usuario
     */
    function usuario_actualizar(){

    }

    /**
        funcion que agrega un usuario 
    */
    function addUsuario()
    {
        //
    }

    /**
        funcion que elimina un usuario indicado por idusuario
     */
    function eliminar(){

    }
    /**
        funcion que inserta un nuevo usuario proporcionado por metodo POST
     */
    function agrega(){

    }



    
}
