<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulos extends Model
{
    protected $fillable = [
        'codigo', 'nombre', 'descripcion', 'imagen'
    ];
}
