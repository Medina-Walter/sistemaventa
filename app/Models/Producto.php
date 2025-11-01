<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{

    protected $table = 'productos';

    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'nombre',
        'codigo',
        'id_imagen',
        'descripcion',
        'stock',
        'precio_compra',
        'precio_venta',
        'id_categoria',
        'id_proveedor',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function imagen()
    {
        return $this->belongsTo(Imagen::class, 'id_imagen');
    }

    public function detallesVenta()
    {
        return $this->hasMany(DetalleVenta::class, 'id_producto');
    }
}
