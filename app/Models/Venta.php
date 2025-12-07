<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = [
        'id_usuario',
        'fecha_venta',
        'total_venta'
    ];

    public function detalleVenta()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta', 'id');
    }


    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }
}
