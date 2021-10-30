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

Route::post('/usuarios/id', 'App\Http\Controllers\UsuarioController@idUsuario');

Route::get('/usuarios/{id}','App\Http\Controllers\UsuarioController@detalle');

Route::put('/usuarios/{id}','App\Http\Controllers\UsuarioController@actualizarUsuario');

Route::delete('/usuarios/{id}','App\Http\Controllers\UsuarioController@deleteUsuario');

/* rutas para incidencias */

Route::get('/incidencias','App\Http\Controllers\IncidenciaController@listado');

Route::post('/incidencias','App\Http\Controllers\IncidenciaController@addIncidencia');

Route::get('/incidencias/{id}','App\Http\Controllers\IncidenciaController@detalle');

/* rutas para logs */

Route::get('/logs','App\Http\Controllers\LogController@listado');

/* borrar */
Route::get('/formulario','App\Http\Controllers\IncidenciaController@solicitud');
Route::post('/datos','App\Http\Controllers\IncidenciaController@datos')->name('datos');