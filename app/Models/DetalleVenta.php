<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_ventas';

    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'precio_unitario',
        'sub_total'
    ];

    // Una línea de detalle pertenece a una venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }

    // Una línea de detalle pertenece a un producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}

