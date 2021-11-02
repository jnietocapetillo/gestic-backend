<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DateTime;
use Illuminate\Database\DBAL\TimestampType;
use PHPUnit\Util\Json;

class UsuarioController extends Controller
{
    /**
        Comprobamos si el correo y la contraseña corresponden a un usuario
     */

    function login(Request $request)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $json = file_get_contents('php://input');
        $datos = json_decode($json);
        
        
        $usuario = User::where('email',$datos->email)->where('password',$datos->password)->first();
        
        
        if (empty($usuario))
        {
            $resultado=201;
            $mensaje='Correo / password incorrecto';
        }
        else
        {
            $resultado = 200;
            //una vez que vemos que existe el usuario debemos saber si esta activo o no
            $mensaje = $usuario;
        } 

        $response = [
            'estado'=>$resultado,
            'datos' => $mensaje
        ];

        header('Content-Type: application/json');
        return json_encode($response);
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
    function actualizarUsuario(Request $request,$id){

        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        
        $actualizar_usuario = User::where('idusuario',$id)->update(['nombre'=>$datos->nombre, 'apellidos'=>$datos->apellidos,
                                                                            'dni'=>$datos->dni, 'departamento'=>$datos->departamento,
                                                                            'movil'=>$datos->movil,'domicilio'=>$datos->domicilio,
                                                                             'localidad'=>$datos->localidad, 'municipio'=>$datos->municipio,
                                                                            'codigo_postal'=>$datos->codigo_postal]);
        $usuarioActualizado = User::where('idusuario',$id)->first();

        if ($actualizar_usuario){
            $estado = 200;
            $usuario = $usuarioActualizado;
        } 
        else $estado = 201;

        $respuesta = [
            'estado'=>$estado,
            'datos' =>$usuario
        ];

        header('Content-Type: application/json');
        return json_encode($respuesta);
    }

    /**
        funcion que elimina un usuario indicado por idusuario
     */
    function deleteUsuario($id){

    }

    /**
    Funcion que devuelve el id de un usuario a través de su correo
     */
    function idUsuarioEmail(Request $request)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $json = file_get_contents('php://input');
        $datos = json_decode($json);
        $id_usuario = User::where('email',$datos->email)->first();

        if (!empty($id_usuario))
            $respuesta = $id_usuario->idusuario;
        else    
            $respuesta = 201;
        
        header('Content-Type: application/json');
        return json_encode($respuesta);
    }

    /**
    Funcion que devuelve el id de un usuario a través de su perfil
     */
    function idUsuarioPerfil(Request $request)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $json = file_get_contents('php://input');
        $datos = json_decode($json);
        $id_usuario = User::where('perfil',$datos->perfil)->first();

        if (!empty($id_usuario))
            $respuesta = $id_usuario->idusuario;
        else    
            $respuesta = 201;
        
        header('Content-Type: application/json');
        return json_encode($respuesta);
    }

    /**
            funcion que resetea la password de un usuario pasado por id
     */
    function resetPassword(Request $request)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $json = file_get_contents('php://input');
        $datos = json_decode($json);
        
        $resetPassword = User::where('idusuario', $datos->id)->update(['password'=>$datos->password]);

        if ($resetPassword)
        {
            $estado = 200;
        }
        else $estado = 201;

        $respuesta = [ 'estado' =>$estado];
        header('Content-Type: application/json');
        return json_encode($respuesta);
    }

    /**
        funcion que inserta un nuevo usuario pasado por post
     */
    function addUsuario(Request $request)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $json = file_get_contents('php://input');
        $datos = json_decode($json);

        $existeUser = User::where('email',$datos->email)->first();
        
        if ($existeUser == null)
        {
            $fecha = new DateTime();
            $estado = 200;
            //insertamos usuario
            $addUser = User::insert([
                'nombre' => $datos->nombre,
                'apellidos' => $datos ->apellidos,
                'dni' => $datos -> dni,
                'email' => $datos ->email,
                'password' => $datos->password,
                'activo' => 0,
                'departamento' =>$datos->departamento,
                'perfil' => $datos->perfil,
                'movil' => $datos -> movil,
                'domicilio' => $datos ->domicilio,
                'localidad' => $datos ->localidad,
                'municipio' => $datos->provincia,
                'codigo_postal' =>$datos -> codigo_postal,
                'avatar' =>''
            ]);
            
        }
        else    
        {
            $estado = 202;
        }
        $respuesta = [ 'estado' =>$estado];
        header('Content-Type: application/json');
        return json_encode($respuesta); 
    }
   
}
