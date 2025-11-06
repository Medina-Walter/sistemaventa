<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores'; // nombre exacto de la tabla

    protected $primaryKey = 'id_proveedor'; // clave primaria personalizada

    public $timestamps = true; // usa created_at y updated_at

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'direccion',
        'sitio_web',
        'nota',
    ];
}
