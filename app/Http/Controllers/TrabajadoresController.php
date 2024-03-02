<?php

namespace App\Http\Controllers;

use App\Models\Trabajadores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TrabajadoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trabajadores = Trabajadores::all();
        return response()->json($trabajadores);
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
            'num_documento' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|email|unique:trabajadores,email',
            'usuario' => 'required|string',
            'password' => 'required|string'
        ]);

        $hashedPassword = Hash::make($request->password);

        $trabajadores = Trabajadores::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'sexo' => $request->sexo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'num_documento' => $request->num_documento,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'usuario' => $request->usuario,
            'password' => $hashedPassword
        ]);

        return response()->json($trabajadores, 201);
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
            $trabajador = Trabajadores::findOrFail($id);
            return response()->json($trabajador);
        } catch (\Exception) {
            return response()->json(['message' => 'Trabajador no encontrado'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trabajadores $trabajadores)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

public function update(Request $request, $id)
{
    try {
        $trabajador = Trabajadores::findOrFail($id);
        $request->validate([
            'nombre' => 'required|string',
            'apellidos' => 'required|string',
            'sexo' => 'required|string',
            'fecha_nacimiento' => 'required|date',
            'num_documento' => 'required|string',
            'direccion' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|email|unique:trabajadores,email,' . $id,
            'usuario' => 'required|string',
            'password' => 'required|string'
        ]);

        // Generar un hash de la contraseña
        $hashedPassword = Hash::make($request->password);

        // Actualizar los datos del trabajador con la contraseña hasheada
        $trabajador->update([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'sexo' => $request->sexo,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'num_documento' => $request->num_documento,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'usuario' => $request->usuario,
            'password' => $hashedPassword
        ]);

        return response()->json($trabajador, 200);
    } catch (\Exception) {
        return response()->json(['message' => 'Error al actualizar el trabajador.'], 500);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $trabajador = Trabajadores::findOrFail($id);
            $trabajador->delete();
            return response()->json(['message' => 'Trabajador eliminado.'], 204);
        } catch (\Exception) {
            return response()->json(['message' => 'Error al eliminar el Trabajador.'], 500);
        }
    }
}
