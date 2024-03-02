<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Clientes::all();
        return response()->json($clientes);
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
                'nombre' => 'required|string',
                'apellidos' => 'required|string',
                'sexo' => 'required|string',
                'fecha_nacimiento' => 'required|date',
                'tipo_documento' => 'required|string',
                'num_documento' => 'required|string',
                'direccion' => 'required|string',
                'telefono' => 'required|string',
                'email' => 'required|email|unique:clientes,email',
            ]);

            $cliente = Clientes::create($request->all());
            return response()->json($cliente, 201);
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
            $cliente = Clientes::findOrFail($id);
            return response()->json($cliente);
        } catch (\Exception) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Clientes $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $cliente = Clientes::findOrFail($id);
            $request->validate([
                'nombre' => 'required|string',
                'apellidos' => 'required|string',
                'sexo' => 'required|string',
                'fecha_nacimiento' => 'required|date',
                'tipo_documento' => 'required|string',
                'num_documento' => 'required|string',
                'direccion' => 'required|string',
                'telefono' => 'required|string',
                'email' => 'required|email|unique:clientes,email' . $id,
            ]);

            $cliente->update($request->all());
            return response()->json($cliente, 200);
        } catch (\Exception) {
            return response()->json(['message' => 'Error al actualizar el cliente.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $cliente = Clientes::findOrFail($id);
            $cliente->delete();
            return response()->json(['message' => 'Cliente eliminado.'], 204);
        } catch (\Exception) {
            return response()->json(['message' => 'Error al eliminar el cliente.'], 500);
        }
    }
}
