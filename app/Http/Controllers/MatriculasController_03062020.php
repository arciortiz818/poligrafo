<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matriculas as Matricula;
use App\Estudiantes as Estudiante;
use App\OrdenPago;
use App;

class MatriculasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $programas = Programa::all();
        // $data = ["programas" => $programas];
        // return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $data = ["metodo" => "formulario crear"];
        // return response()->json($data, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $programa = new Programa();
        // $datos = $request->all();
        // $programa->nombre = $datos['nombre'];
        // $programa->plan = $datos['plan'];
        // $guardado = $programa->save();
        // $data = ["programa_guardado" => $guardado];
        // return response()->json($data, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        // $programa = Programa::find($id);
        // $data = ["programa" => $programa];
        // return response()->json($data, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $data = ["metodo" => "formulario editar"];
        // return response()->json($data, 200);
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

        // $newPrograma =  $request->all();
        // $data = Programa::where('id',$id)->update($newPrograma);
        // return response()->json($data, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $data = Programa::where('id',$id)->delete();
        // return response()->json($data, 200);
    }

    public function reportePDF($documentoEstudiante)
    {

        $estudiante = Estudiante::select("numero_documento","nombre","numero_celular as celular")
                        ->where("numero_documento","=",$documentoEstudiante)->get();

        $detalle = Matricula::select("materias.codigo","materias.nombre as materia", "materias.creditos", "materias.valor","matriculas.id_orden_pago")
                    ->join("estudiantes","matriculas.id_estudiante","=","estudiantes.id")
                    ->join("materias","matriculas.id_materia","=","materias.id")
                    ->where('estudiantes.numero_documento',$documentoEstudiante)->get();

        $encabezado = OrdenPago::select("id","consecutivo","fecha_generada","fecha_vencimiento","subtotal","descuento","total","observaciones")
                        ->where("id","=",$detalle[0]->id_orden_pago)->get();
        $data = [ "encabezado" => $encabezado[0], "estudiante" => $estudiante[0], "detalle" => $detalle ];

        $pdf = App::make("dompdf.wrapper");
        $pdf->loadView("reporte",$data)->setPaper('letter','portrait');
        return $pdf->stream();
        //return response()->json($data, 200);
        // return view('reporte',$data);
    }
}
