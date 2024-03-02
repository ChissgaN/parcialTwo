<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detalle_ventas extends Model
{
    protected $fillable = [
        'ventas_id', 'detalle_ingresos_id', 'cantidad', 'descuento'
    ];
}
