<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_ingresos extends Model
{
    protected $fillable = [
        'articulo_id', 'precio_compra', 'precio_venta', 'stock_inicial', 'stock_actual', 'fecha_produccion', 'fecha_vencimiento'
    ];
}
