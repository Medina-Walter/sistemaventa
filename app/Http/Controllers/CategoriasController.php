<?php

namespace App\Http\Controllers;

use App\Repositories\CategoriaRepository;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class CategoriasController extends Controller
{
    protected $categoriaRepository;

    public function __construct(CategoriaRepository $categoriaRepository)
    {
        $this->categoriaRepository = $categoriaRepository;
    }

    public function index()
    {
        $categorias = $this->categoriaRepository->obtenerTodos();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        try {
            $datos = $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
            ]);

            $this->categoriaRepository->crear($datos);

            return redirect()->route('categorias.index')->with('success', 'Categoría creada con éxito.');
        } catch (Exception $e) {
            return redirect()->route('categorias.index')->with('error', 'Error al crear la categoría.'. $e->getMessage());
        }
    }

    public function show($id)
    {
        $categoria = $this->categoriaRepository->obtenerPorId($id);

        if (!$categoria) {
            return redirect()->route('categorias.index')
                ->withErrors('La categoría no existe.');
        }

        return view('categorias.show', compact('categoria'));
    }

    public function edit($id)
    {
        $categoria = $this->categoriaRepository->obtenerPorId($id);

        if (!$categoria) {
            return redirect()->route('categorias.index')
                ->withErrors('La categoría no existe.');
        }

        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        try {
            $datos = $request->validate([
                'nombre' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
            ]);

            $this->categoriaRepository->actualizar($id, $datos);

            return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente.');
        } catch (Exception $e) {
            Log::error('Error al actualizar categoría');
            return redirect()->route('categorias.index')->with('error', 'Error al actualizar la categoría.' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->categoriaRepository->eliminar($id);
            return redirect()->route('categorias.index')
                ->with('success', '✅ Categoría eliminada correctamente.');
        } catch (Exception $e) {
            Log::error('Error al eliminar categoría');
            return redirect()->route('categorias.index')->with('error', 'No se pudo eliminar la categoría.' . $e->getMessage());
        }
    }
}
