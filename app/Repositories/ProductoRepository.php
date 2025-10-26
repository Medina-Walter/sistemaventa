<?php

namespace App\Repositories;

use App\Models\Producto;

class ProductoRepository
{
    public function obtenerTodos()
    {
        return Producto::all();
    }

    public function obtenerPorId($id)
    {
        return Producto::find($id);
    }

    public function crear(array $datos)
    {
        return Producto::create($datos);
    }

    public function actualizar($id, array $datos)
    {
        $producto = Producto::find($id);
        if ($producto) {
            $producto->update($datos);
        }
        return $producto;
    }

    public function eliminar($id)
    {
        $producto = Producto::find($id);
        if ($producto) {
            $producto->delete();
        }
        return $producto;
    }
}
