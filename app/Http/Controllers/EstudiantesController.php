<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Estudiantes as Estudiante;

class EstudiantesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estudiantes = Estudiante::all();
        $data = ["estudiantes" => $estudiantes];
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = ["metodo" => "formulario crear"];
        return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $estudiante = new Estudiante();
        $datos = $request->all();
        $estudiante->nombre = $datos['nombre'];
        $estudiante->numero_documento = $datos['numero_documento'];
        $estudiante->email = $datos['email'];
        $estudiante->numero_celular = $datos['numero_celular'];
        $estudiante->tipo_documento = $datos['tipo_documento'];
        $guardado = $estudiante->save();
        $data = ["estudiante_guardado" => $guardado];
        return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $estudiante = Estudiante::find($id);
        $data = ["estudiante" => $estudiante];
        return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = ["metodo" => "formulario editar"];
        return response()->json($data, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $newEstudiante =  $request->all();
        $data = Estudiante::where('id',$id)->update($newEstudiante);
        return response()->json($data, 200);
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Estudiante::where('id',$id)->delete();
        return response()->json($data, 200);
    }
}
