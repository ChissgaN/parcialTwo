<?php

use App\Http\Controllers\ArticulosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DetalleIngresosController;
use App\Http\Controllers\DetalleVentasController;
use App\Http\Controllers\TrabajadoresController;
use App\Http\Controllers\VentasController;
use App\Models\detalle_ingresos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('clientes', ClientesController::class);
Route::resource('trabajadores', TrabajadoresController::class);
Route::resource('ventas',  VentasController::class);
Route::resource('articulos', ArticulosController::class);
Route::resource('detalle_ingresos', DetalleIngresosController::class);
Route::resource('detalle_ventas', DetalleVentasController::class);
