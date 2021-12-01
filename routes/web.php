<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* rutas para login usuarios */

Route::post('/login','App\Http\Controllers\UsuarioController@login');

Route::post('/usuarios/reset', 'App\Http\Controllers\UsuarioController@resetPassword');

Route::get('/usuarios', 'App\Http\Controllers\UsuarioController@listado');

Route::get('/usuario/detalle/{id}', 'App\Http\Controllers\UsuarioController@detalleUsuario');

Route::post('/usuarios', 'App\Http\Controllers\UsuarioController@addUsuario');

Route::post('/usuarios/idEmail', 'App\Http\Controllers\UsuarioController@idUsuarioEmail');

Route::get('/usuario/idPerfil/{id}','App\Http\Controllers\UsuarioController@idUsuarioPerfil' );

Route::post('/usuarios/add','App\Http\Controllers\UsuarioController@addUsuario');

Route::get('/usuario/desactivar/{id}','App\Http\Controllers\UsuarioController@desactivarUsuario' );

Route::put('/usuarios/{id}','App\Http\Controllers\UsuarioController@actualizarUsuario');

Route::delete('/usuarios/{id}','App\Http\Controllers\UsuarioController@deleteUsuario');

Route::get('/usuarios/nombre/{id}','App\Http\Controllers\UsuarioController@nombreUsuario');

Route::post('/usuario/imagen', 'App\Http\Controllers\UsuarioController@addImagenUsuario');

Route::get('usuario/activar/{id}', 'App\Http\Controllers\UsuarioController@activarUsuario');

Route::get('/usuario/tecnicos','App\Http\Controllers\UsuarioController@tecnicosUsuarios' );

/* rutas para incidencias */

Route::get('/incidencias','App\Http\Controllers\IncidenciaController@listado');

Route::post('/incidencia/add', 'App\Http\Controllers\IncidenciaController@addIncidencia');

Route::get('/incidencia/{id}','App\Http\Controllers\IncidenciaController@detalle');

Route::delete('/incidencias/{id}', 'App\Http\Controllers\IncidenciaController@deleteIncidencia');

Route::get('/incidencia/usuario/{id}','App\Http\Controllers\IncidenciaController@incidenciasUsuario' );

Route::post('/incidencia/imagen','App\Http\Controllers\IncidenciaController@incidenciaImagen');

Route::get('/incidencia/tecnico/{id}','App\Http\Controllers\IncidenciaController@tecnicoIncidencia');

Route::get('incidencia/idincidencia/{id}', 'App\Http\Controllers\IncidenciaController@idUsuarioIncidencia');

Route::post('incidencia/asignar', 'App\Http\Controllers\IncidenciaController@asignarTecnicoPrioridad');

Route::post('/incidencias/tecnico', 'App\Http\Controllers\IncidenciaController@incidenciasTecnico');

Route::put('/incidencia/update', 'App\Http\Controllers\IncidenciaController@updateIncidencia');

/* rutas para logs */

Route::get('/logs','App\Http\Controllers\LogController@listado');

/* borrar */
Route::get('/formulario','App\Http\Controllers\IncidenciaController@solicitud');

Route::post('/datos','App\Http\Controllers\IncidenciaController@datos')->name('datos');

/** rutas para los mensajes */

Route::post('/mensaje/add', 'App\Http\Controllers\MensajeController@addMensaje');
Route::post('/mensaje/imagen','App\Http\Controllers\MensajeController@mensajeImagen');
Route::get('/mensajes/{id}','App\Http\Controllers\MensajeController@mensajesUsuarios' );
Route::get('/mensaje/{id}','App\Http\Controllers\MensajeController@detalleMensaje');
Route::get('/mensajes/incidencia/{id}', 'App\Http\Controllers\MensajeController@mensajesIncidencias');
Route::put('/mensaje/leido/{id}', 'App\Http\Controllers\MensajeController@mensajeLeido');
Route::get('/mensajesnoleidos/{id}', 'App\Http\Controllers\MensajeController@mensajesNoLeidosUsuarios');
Route::get('/mensaje/actualizarMensaje/{id}','App\Http\Controllers\MensajeController@actualizarLeidoPorIncidencia' );


/** rutas para departamentos */

Route::get('/departamentos','App\Http\Controllers\DepartamentoController@listado');
Route::get('/departamento/{id}','App\Http\Controllers\DepartamentoController@departamentoUsuario');
Route::post('/departamento/add', 'App\Http\Controllers\DepartamentoController@addDepartamento');

/** rutas para perfiles */

Route::get('/perfiles', 'App\Http\Controllers\PerfilController@perfiles');
Route::get('/perfil/{id}','App\Http\Controllers\PerfilController@perfilUsuario');
Route::get('/perfil/nombre/{nombre}','App\Http\Controllers\PerfilController@perfilNombre');
Route::post('/perfil/add', 'App\Http\Controllers\PerfilController@addPerfil');

/** ruta para solicitar imagen */
Route::get('/storage/{imagen}', function ($imagen){
    
    return Storage::download($imagen);
});

/** Envio de emails */
Route::post('/email', 'App\Http\Controllers\envioCorreos@enviarCorreo');

/** exportar e importar a excel */
Route::get('/usuarios/excel','App\Http\Controllers\UsuarioController@usuariosExcel');
Route::get('/incidencias/excel','App\Http\Controllers\IncidenciaController@exportarAexcel');
Route::get('/logs/excel', 'App\Http\Controllers\LogController@exportarAexcel');