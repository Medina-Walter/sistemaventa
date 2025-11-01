<?php

namespace App\Http\Controllers;

use App\Repositories\ProductoRepository;
use Exception;
use Illuminate\Http\Request;

class ProductosController extends Controller
{

    protected $productoRepository;

    public function __construct(ProductoRepository $productoRepository)
    {
        $this->productoRepository = $productoRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = $this->productoRepository->obtenerTodos();
        return view('modules.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('modules.productos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $datos = $request->validate([
                'nombre' => 'required|string|max:255',
                'codigo' => 'required|string|max:50',
                'descripcion' => 'required|string|max:255',
                'stock' => 'required|integer|min:0',
                'precio_compra' => 'required|numeric|min:0',
                'precio_venta' => 'required|numeric|min:0',
                'id_imagen' => 'nullable|integer',
                'id_categoria' => 'nullable|integer',
            ]);

            $this->productoRepository->crear($datos);

            return redirect()
                ->route('productos.index')
                ->with('success', 'Producto creado con éxito');

        } catch (Exception $e) {

            return redirect()
                ->route('productos.index')
                ->with('error', 'Error al crear producto: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $producto = $this->productoRepository->obtenerPorId($id);

        if (!$producto) {
            return redirect()->route('productos.index')->withErrors('El producto no existe.');
        }

        return view('modules.productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = $this->productoRepository->obtenerPorId($id);

        return view('modules.productos.edit', compact('producto'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $datos = $request->validate([
                'nombre' => 'required|string|max:255',
                'codigo' => 'required|string|max:50',
                'descripcion' => 'required|string|max:255',
                'stock' => 'required|integer|min:0',
                'precio_compra' => 'required|numeric|min:0',
                'precio_venta' => 'required|numeric|min:0',
                'id_imagen' => 'nullable|integer',
                'id_categoria' => 'nullable|integer',
            ]);

            $this->productoRepository->actualizar($id, $datos);

            return redirect()
                ->route('productos.index')
                ->with('success', 'Producto actualizado correctamente');

        } catch (Exception $e) {

            return redirect()
                ->route('productos.index')
                ->with('error', 'No se pudo actualizar: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            $this->productoRepository->eliminar($id);

            return redirect()
                ->route('productos.index')
                ->with('success', 'Producto eliminado correctamente');

        } catch (Exception $e) {

            return redirect()
                ->route('productos.index')
                ->with('error', 'No se pudo eliminar el producto: ' . $e->getMessage());
        }
    }
}
