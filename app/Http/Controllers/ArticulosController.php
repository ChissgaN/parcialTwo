<?php

namespace App\Http\Controllers;

use App\Models\Articulos;
use Illuminate\Http\Request;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articulos = Articulos::all();
        return response()->json($articulos);
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
                'codigo' => 'required|string|unique:articulos,codigo',
                'nombre' => 'required|string',
                'descripcion' => 'required|string',
                'imagen' => 'required|string',
            ]);

            $articulo = Articulos::create($request->all());
            return response()->json($articulo, 201);
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
            $articulo = Articulos::findOrFail($id);
            return response()->json($articulo);
        } catch (\Exception) {
            return response()->json(['message' => 'Articulo no encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articulos $articulos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $articulos = Articulos::findOrFail($id);
            $request->validate([
                'codigo' => 'required|string|unique:articulos,codigo,' . $id,
                'nombre' => 'required|string',
                'descripcion' => 'required|string',
                'imagen' => 'required|string',
            ]);

            $articulos->update($request->all());
            return response()->json($articulos, 200);
        } catch (\Exception) {
            return response()->json(['message' => 'Error al actualizar el Articulo.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $articulo = Articulos::findOrFail($id);
            $articulo->delete();
            return response()->json(['message' => 'Articulo eliminado.'], 204);
        } catch (\Exception) {
            return response()->json(['message' => 'Error al eliminar el Articulo.'], 500);
        }
    }
}
