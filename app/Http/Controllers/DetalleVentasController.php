<?php

namespace App\Http\Controllers;

use App\Models\detalle_ventas;
use Illuminate\Http\Request;

class DetalleVentasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detallesVentas = detalle_ventas::all();
        return response()->json($detallesVentas);
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
                'ventas_id' => 'required|integer',
                'detalle_ingresos_id' => 'required|integer',
                'cantidad' => 'required|string',
                'descuento' => 'required|numeric',
            ]);

            $detalleVenta = detalle_ventas::create($request->all());
            return response()->json($detalleVenta, 201);
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
            $detalleVenta = detalle_ventas::findOrFail($id);
            return response()->json($detalleVenta);
        } catch (\Exception) {
            return response()->json(['message' => 'Detalle de venta no encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(detalle_ventas $detalle_ventas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $detalleVentas = detalle_ventas::findOrFail($id);
            $request->validate([
                'ventas_id' => 'required|integer',
                'detalle_ingresos_id' => 'required|integer',
                'cantidad' => 'required|string',
                'descuento' => 'required|numeric',
            ]);

            $detalleVentas->update($request->all());
            return response()->json($detalleVentas, 200);
        } catch (\Exception) {
            return response()->json(['message' => 'Error al actualizar el detalle de Ventas.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $detalleVentas = detalle_ventas::findOrFail($id);
            $detalleVentas->delete();
            return response()->json(['message' => 'Detalles de venta eliminado.'], 204);
        } catch (\Exception) {
            return response()->json(['message' => 'Error al eliminar el detalle de venta.'], 500);
        }
    }
}
