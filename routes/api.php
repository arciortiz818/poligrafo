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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    $this->info('Message');
    return $request->user();
});

$routes_except = ['except' => ['create','edit']];


Route::resource('/programas', 'ProgramasController', $routes_except);
Route::resource('/estudiantes', 'EstudiantesController', $routes_except);
Route::resource('/materias', 'MateriasController', $routes_except);
Route::resource('/matriculas', 'MatriculasController', $routes_except);
Route::get('/estudiantes/documento/{documento}','EstudiantesController@estudianteByDocumento');
Route::get('/materias/programa/{idPrograma}','MateriasController@getMateriasByPrograma');
Route::get('/matriculas/estudiante/{documentoEstudiante}','MatriculasController@reportePDF');
