<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OrdenPago as OrdenPago;

class OrdenPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordenPago = OrdenPago::max('id');
        $data = ["ordenPago" => $ordenPago];
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
        $ordenPago = new OrdenPago();
        $datos = $request->all();
        $ordenPago->id = $datos['id'];
        $ordenPago->fecha_pago_ordinario = $datos['fecha_pago_ordinario'];
        $ordenPago->fecha_pago_extra = $datos['fecha_pago_extra'];
        $ordenPago->subtotal = $datos['subtotal'];
        $ordenPago->descuento = $datos['descuento'];
        $ordenPago->id_estudiante = $datos['id_estudiante'];
        $ordenPago->periodo = $datos['periodo'];
        $guardado = $ordenPago->save();
        $data = ["ordenPago_guardado" => $guardado];
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

        $ordenPago = OrdenPago::find($id);
        $data = ["ordenPago" => $ordenPago];
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
        
        $newOrdenPago =  $request->all();
        $data = OrdenPago::where('id',$id)->update($newOrdenPago);
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
        $data = OrdenPago::where('id',$id)->delete();
        return response()->json($data, 200);
    }
}
