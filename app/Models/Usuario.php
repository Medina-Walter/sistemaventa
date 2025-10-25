<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre',
        'apellido',
        'usuario',
        'clave',
        'rol',
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_usuario');
    }
}
