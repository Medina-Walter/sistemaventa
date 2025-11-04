<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'nombre',
        'codigo',
        'descripcion',
        'stock',
        'precio_compra',
        'precio_venta',
        'id_categoria',
        'id_proveedor',
        'id_imagen',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function imagen()
    {
        return $this->belongsTo(Imagen::class, 'id_imagen');
    }
}
