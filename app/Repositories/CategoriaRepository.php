<?php

namespace App\Repositories;

use App\Models\Categoria;
use Exception;

class CategoriaRepository
{
    public function obtenerTodos()
    {
        return Categoria::all();
    }

    public function obtenerPorId($id)
    {
        return Categoria::find($id);
    }

    public function crear(array $datos)
    {
        return Categoria::create($datos);
    }

    public function actualizar($id, array $datos)
    {
        $categoria = Categoria::find($id);
        if (!$categoria) {
            throw new Exception("La categoría no existe.");
        }

        $categoria->update($datos);
        return $categoria;
    }

    public function eliminar($id)
    {
        $categoria = Categoria::find($id);
        if (!$categoria) {
            throw new Exception("La categoría no existe.");
        }

        $categoria->delete();
    }
}
