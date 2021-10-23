<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/* rutas para login usuarios */

Route::middleware('cors')->post('/login','App\Http\Controllers\UsuarioController@login');

Route::get('/usuarios', 'App\Http\Controllers\UsuarioController@listado');

Route::post('/usuarios', 'App\Http\Controllers\UsuarioController@addUsuario');

Route::get('/usuarios/{id}','App\Http\Controllers\UsuarioController@detalle');

/* rutas para incidencias */

Route::get('/incidencias','App\Http\Controllers\IncidenciaController@listado');

Route::post('/incidencias','App\Http\Controllers\IncidenciaController@addIncidencia');

Route::get('/incidencias/{id}','App\Http\Controllers\IncidenciaController@detalle');

/* rutas para logs */

Route::get('/logs','App\Http\Controllers\LogController@listado');

/* borrar */
Route::get('/formulario','App\Http\Controllers\IncidenciaController@solicitud');
Route::post('/datos','App\Http\Controllers\IncidenciaController@datos')->name('datos');