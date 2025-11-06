<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'apellido',
        'usuario',
        'correo',
        'password',
        'rol',
        'estado',
    ];

    /**
     * Encripta la contraseña solo si no está encriptada
     */
    public function setPasswordAttribute($value)
{
    if (Hash::needsRehash($value)) {
        $this->attributes['password'] = Hash::make($value);
    } else {
        $this->attributes['password'] = $value;
    }
}


    public function ventas()
    {
        return $this->hasMany(Venta::class, 'id_usuario');
    }
}
