<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matriculas as Matricula;
use App\Estudiantes as Estudiante;
use App\OrdenPago as OrdenPago;
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
        $matriculas = Matricula::all();
        $data = ["matriculas" => $matriculas];
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
        $matricula = new Matricula();
        $datos = $request->all();
        $matricula->id_materia = $datos['id_materia'];
        $matricula->id_orden_pago = $datos['id_orden_pago'];
        $guardado = $matricula->save();
        $data = ["matricula_guardado" => $guardado];
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

        $programa = Programa::find($id);
        $data = ["programa" => $programa];
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

        $newPrograma =  $request->all();
        $data = Programa::where('id',$id)->update($newPrograma);
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
        $data = Programa::where('id',$id)->delete();
        return response()->json($data, 200);
    }

    public function reportePDF($documentoEstudiante)
    {

        $estudiante = Estudiante::select("id","numero_documento","nombre","numero_celular as celular")
                        ->where("numero_documento","=",$documentoEstudiante)->get();

        $encabezado = OrdenPago::select("id","consecutivo","fecha_pago_ordinario","fecha_pago_extra","subtotal","descuento","observaciones")
                        ->where("id_estudiante","=",$estudiante[0]->id)->get();

        $detalle = Matricula::select("materias.codigo","materias.nombre as materia", "materias.creditos", "materias.valor")
                    ->join("materias","matriculas.id_materia","=","materias.id")
                    ->where('matriculas.id_orden_pago',"=",$encabezado[0]->id)->get();


        $data = [ "encabezado" => $encabezado[0], "estudiante" => $estudiante[0], "detalle" => $detalle ];

        $pdf = App::make("dompdf.wrapper");
        $pdf->loadView("reporte2",$data)->setPaper('legal','portrait');
        return $pdf->stream();
        //return response()->json($data, 200);
        // return view('reporte',$data);
    }
}
