<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perfil;
use Barryvdh\DomPDF\PDF;
use DateTime;



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
        
        
        $usuario = User::where('email',$datos->email)->first();
        
        if (empty($usuario))
        {
            $resultado=201;
            $mensaje='Correo incorrecto';
        }
        else
        {
            //si existe el usuario veo si coinciden las contraseñas
            if (password_verify($datos->password,$usuario->password))
            {
                $resultado = 200;
                //una vez que vemos que existe el usuario debemos saber si esta activo o no
                $mensaje = $usuario;
            }
            else 
            {
                $resultado=201;
                $mensaje='Password incorrecta';
            }
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

        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

        $listado = User::all();

        return json_encode($listado);
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
    function idUsuarioPerfil($id)
    {

        $id_usuario = User::where('idPerfil',$id)->first();

        if (!empty($id_usuario))
            $respuesta = $id_usuario->idusuario;
        else    
            $respuesta = 201;
        
        $respuesta = ['id'=> $respuesta];
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
        $nueva = password_hash($datos->password,PASSWORD_BCRYPT);
        $resetPassword = User::where('idusuario', $datos->id)->update(['password'=>$nueva]);

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
            $pass = password_hash($datos->password,PASSWORD_BCRYPT);
            $fecha = new DateTime();
            $estado = 200;
            //insertamos usuario
            $addUser = User::insert([
                'nombre' => $datos->nombre,
                'apellidos' => $datos ->apellidos,
                'dni' => $datos -> dni,
                'email' => $datos ->email,
                'password' => $pass,
                'activo' => 0,
                'idDepartamento' =>$datos->departamento,
                'idPerfil' => $datos->perfil,
                'movil' => $datos -> movil,
                'domicilio' => $datos ->domicilio,
                'localidad' => $datos ->localidad,
                'municipio' => $datos->provincia,
                'codigo_postal' =>$datos -> codigo_postal,
                'avatar' =>$datos ->imagen
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

    /**
        funcion que envia el nombre y apellidos del usuario pasado por id 
     */
    function nombreUsuario($id)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $nombre = User::where('idusuario',$id)->first();

        return json_encode($nombre->nombre.' '.$nombre->apellidos);
    }

    /**
        funcion que agrega una imagen al perfil de usuario
     */

    function addImagenUsuario(Request $request)
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

        $usuario_creado = User::max('idincidencia');
        $usuario = User::where('idincidencia',$usuario_creado)->update(['avatar'=>$nombreArchivo]);
        
        if ($usuario)
            $respuesta = 200;
        else
            $respuesta = 201;    
        
        header('Content-Type: application/json');
        return json_encode($respuesta); 

    }

    /**
        funcion que activa un usuario pasado por id
     */
    function activarUsuario($id)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $usuarioActivo = User::where('idusuario',$id)->update(['activo'=>1]);

        if ($usuarioActivo)
        {
            $respuesta = 200;
        }
        else
        {
            $respuesta = 201;
        }

        return json_encode($respuesta);
    }

    /**
        funcion que devuelve los usuarios que son técnicos
     */
    function tecnicosUsuarios()
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");

        $idTecnico = Perfil::where('nombre','like','Tecnico')->first();

        $tecnicos = User::where('idPerfil',$idTecnico->id)->get();

        return json_encode($tecnicos);
    }
    
}
