<?php

namespace App\Repositories;

use App\Models\Proveedor;
use Exception;

class ProveedorRepository
{
    public function obtenerTodos()
    {
    return Proveedor::paginate(10);
    }


    public function obtenerPorId($id)
    {
        return Proveedor::find($id);
    }

    public function crear(array $datos)
    {
        return Proveedor::create($datos);
    }

    public function actualizar($id, array $datos)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            throw new Exception("El proveedor no existe.");
        }

        $proveedor->update($datos);
        return $proveedor;
    }

    public function eliminar($id)
    {
        $proveedor = Proveedor::find($id);
        if (!$proveedor) {
            throw new Exception("El proveedor no existe.");
        }

        $proveedor->delete();
    }
}
