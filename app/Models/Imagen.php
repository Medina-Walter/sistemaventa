<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;

    protected $table = 'imagenes';
    protected $primaryKey = 'id';

    protected $fillable = ['nombre', 'ruta'];

    public function producto()
    {
        return $this->hasOne(Producto::class, 'id_imagen');
    }
}
