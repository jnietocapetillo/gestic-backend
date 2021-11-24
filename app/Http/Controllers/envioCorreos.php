<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Mail\Emails;
use Illuminate\Support\Facades\Mail;
use Exception;

class envioCorreos extends Controller
{
    function enviarCorreo(Request $request)
    {
        header('Access-Control-Allow-Origin: *'); 
        header("Access-Control-Allow-Headers: *");
       
        $json = file_get_contents('php://input'); //recibimos el json de angular
        $parametros = json_decode($json);// decodifica el json y lo guarda en paramentros
        
        try{
            Mail::to($parametros->para)->send(new \App\Mail\Emails($parametros));
            $resultado = 200;
            $mensaje = 'Email enviado correctamente';
        }
        catch(Exception $e)
        {
            $resultado = 201;
            $mensaje = $e;
        }
        
        $respuesta = [
            'resultado'=>$resultado,
            'mensaje'=>$mensaje
        ];

        return json_encode($respuesta);
    }
}
