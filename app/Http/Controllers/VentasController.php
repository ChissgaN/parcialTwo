<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Ventas::all();
        return response()->json($ventas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'cliente_id' => 'required|integer',
                'trabajador_id' => 'required|integer',
                'fecha' => 'required|date',
                'tipo_comprobante' => 'required|string',
                'serie' => 'required|string|unique:ventas,serie',
                'correlativo' => 'required|string',
                'igv' => 'required|numeric',
                'estado' => 'required|string',
            ]);

            $venta = Ventas::create($request->all());
            return response()->json($venta, 201);
        } catch (\Exception) {
            return response()->json(['message' => 'Valores ingresados incorrectos'], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $venta = Ventas::findOrFail($id);
            return response()->json($venta);
        } catch (\Exception) {
            return response()->json(['message' => 'Venta no encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ventas $ventas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    try {
        $venta = Ventas::findOrFail($id);
        $request->validate([
            'cliente_id' => 'required|integer',
            'trabajador_id' => 'required|integer',
            'fecha' => 'required|date',
            'tipo_comprobante' => 'required|string',
            'serie' => 'required|string|unique:ventas,serie,' . $id, 
            'correlativo' => 'required|string',
            'igv' => 'required|numeric',
            'estado' => 'required|string',
        ]);

        $venta->update($request->all());
        return response()->json($venta, 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error al actualizar la Venta.'], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $ventas = Ventas::findOrFail($id);
            $ventas->delete();
            return response()->json(['message' => 'Venta eliminado.'], 204);
        } catch (\Exception) {
            return response()->json(['message' => 'Error al eliminar la Venta.'], 500);
        }
    }
}
