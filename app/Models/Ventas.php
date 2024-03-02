<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $fillable = [
        'cliente_id', 'trabajador_id', 'fecha', 'tipo_comprobante', 'serie', 'correlativo', 'igv', 'estado'
    ];
}
