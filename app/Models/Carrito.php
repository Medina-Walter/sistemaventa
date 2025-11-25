<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carrito'; // nombre exacto de la tabla
    protected $primaryKey = 'id'; // ajusta si tu PK es distinta

    protected $fillable = [
        'codigo_barra',
        'nombre',
        'cantidad',
        'precio',
    ];
}

