<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;


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

Route::post('/usuarios', 'App\Http\Controllers\UsuarioController@addUsuario');

Route::post('/usuarios/idEmail', 'App\Http\Controllers\UsuarioController@idUsuarioEmail');

Route::get('/usuario/idPerfil/{id}','App\Http\Controllers\UsuarioController@idUsuarioPerfil' );

Route::post('/usuarios/add','App\Http\Controllers\UsuarioController@addUsuario');

Route::get('/usuarios/{id}','App\Http\Controllers\UsuarioController@detalle');

Route::put('/usuarios/{id}','App\Http\Controllers\UsuarioController@actualizarUsuario');

Route::delete('/usuarios/{id}','App\Http\Controllers\UsuarioController@deleteUsuario');

Route::get('/tecnico/{id}','App\Http\Controllers\UsuarioController@nombreTecnico');


/* rutas para incidencias */

Route::get('/incidencias','App\Http\Controllers\IncidenciaController@listado');

Route::post('/incidencia/add', 'App\Http\Controllers\IncidenciaController@addIncidencia');

Route::get('/incidencia/{id}','App\Http\Controllers\IncidenciaController@detalle');

Route::get('/incidencia/usuario/{id}','App\Http\Controllers\IncidenciaController@incidenciasUsuario' );

Route::post('/incidencia/imagen','App\Http\Controllers\IncidenciaController@incidenciaImagen');

/* rutas para logs */

Route::get('/logs','App\Http\Controllers\LogController@listado');

/* borrar */
Route::get('/formulario','App\Http\Controllers\IncidenciaController@solicitud');
Route::post('/datos','App\Http\Controllers\IncidenciaController@datos')->name('datos');

/** rutas para los mensajes */

Route::post('/mensaje/add', 'App\Http\Controllers\MensajeController@addMensaje');
Route::get('/mensajes/{id}','App\Http\Controllers\MensajeController@mensajesUsuarios' );
Route::get('/mensajes/incidencia/{id}', 'App\Http\Controllers\MensajeController@mensajesIncidencias');

/** rutas para departamentos */

Route::get('/departamentos','App\Http\Controllers\DepartamentoController@listado');
Route::get('/departamento/{id}','App\Http\Controllers\DepartamentoController@departamentoUsuario');

/** rutas para perfiles */

Route::get('/perfiles', 'App\Http\Controllers\PerfilController@perfiles');
Route::get('/perfil/{id}','App\Http\Controllers\PerfilController@perfilUsuario');
Route::get('/perfil/nombre/{nombre}','App\Http\Controllers\PerfilController@perfilNombre');

Route::get('/prueba','App\Http\Controllers\IncidenciaController@prueba');