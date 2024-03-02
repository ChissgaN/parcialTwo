<?php

namespace App\Http\Controllers;

use App\Models\detalle_ingresos;
use Illuminate\Http\Request;

class DetalleIngresosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalleIngresos = detalle_ingresos::all();
        return response()->json($detalleIngresos);
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
                'articulo_id' => 'required|integer',
                'precio_compra' => 'required|numeric',
                'precio_venta' => 'required|numeric',
                'stock_inicial' => 'required|integer',
                'stock_actual' => 'required|integer',
                'fecha_produccion' => 'required|date',
                'fecha_vencimiento' => 'required|date',
                
            ]);

            $detalleIngreso = detalle_ingresos::create($request->all());
            return response()->json($detalleIngreso, 201);
        } catch (\Exception $e) {
                return response()->json(['message' => 'Valores ingresados incorrectos. Error: ' . $e->getMessage()], 400);
            }
            
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $detalleIngresos = detalle_ingresos::findOrFail($id);
            return response()->json($detalleIngresos);
        } catch (\Exception) {
            return response()->json(['message' => 'Detalle de ingreso no encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detalle_ingresos $detalle_ingresos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $detalleIngresos = detalle_ingresos::findOrFail($id);
            $request->validate([
                'articulo_id' => 'required|integer',
                'precio_compra' => 'required|numeric',
                'precio_venta' => 'required|numeric',
                'stock_inicial' => 'required|integer',
                'stock_actual' => 'required|integer',
                'fecha_produccion' => 'required|date',
                'fecha_vencimiento' => 'required|date',
            ]);

            $detalleIngresos->update($request->all());
            return response()->json($detalleIngresos, 200);
        } catch (\Exception) {
            return response()->json(['message' => 'Error al actualizar un detalle de ingreso.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $detalleIngresos = detalle_ingresos::findOrFail($id);
            $detalleIngresos->delete();
            return response()->json(['message' => 'Detalle de ingreso eliminado.'], 204);
        } catch (\Exception) {
            return response()->json(['message' => 'Error al eliminar el Detalle de ingreso.'], 500);
        }
    }
}
