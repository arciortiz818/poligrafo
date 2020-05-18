<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materias as Materia;
use App\Programas as Programa;

class MateriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias = Materia::select(
            "materias.*","programas.nombre as nombre_programa")
            ->join("programas","materias.id_programa","=","programas.id")
            ->get();
        
        $data = ["materias" => $materias];
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
        $materia = new Materia();
        $datos = $request->all();
        $materia->nombre = $datos['nombre'];
        $materia->creditos = $datos['creditos'];
        $materia->valor = $datos['valor'];
        $materia->id_programa = $datos['id_programa'];
        $guardado = $materia->save();
        $data = ["materia_guardada" => $guardado];
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

        $materia = Materia::find($id);
        $data = ["materia" => $matria];
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
        
        $newMateria =  $request->all();
        
        $data = Materia::where('id',$id)->update(array(
            "nombre"=>$newMateria['nombre'],
            "creditos"=>$newMateria['creditos'],
            "valor" => $newMateria['valor'],
            "id_programa" => $newMateria['id_programa']
        ));
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
        $data = Materia::where('id',$id)->delete();
        return response()->json($data, 200);
    }
}
