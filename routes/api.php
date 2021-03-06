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

header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    $this->info('Message');
    return $request->user();
});

$routes_except = ['except' => ['create','edit']];


Route::resource('/programas', 'ProgramasController', $routes_except);
Route::resource('/estudiantes', 'EstudiantesController', $routes_except);
Route::resource('/materias', 'MateriasController', $routes_except);
Route::resource('/matriculas', 'MatriculasController', $routes_except);
Route::resource('/orden_pago', 'OrdenPagoController', $routes_except);
Route::get('/estudiantes/documento/{documento}','EstudiantesController@estudianteByDocumento');
Route::get('/materias/programa/{codigo}','MateriasController@getMateriasByPrograma');