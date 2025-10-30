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
        'correo',
        'password',
        'rol',
        'estado',
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_usuario');
    }
}
