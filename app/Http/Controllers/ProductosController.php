<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;
use App\Models\Imagen;
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

    public function index(Request $request)
    {
        $query = $request->input('buscar');

        $productos = Producto::with(['categoria', 'imagen'])
            ->where(function ($q) use ($query) {
                if ($query) {
                    $q->where('nombre', 'like', "%{$query}%")
                      ->orWhere('codigo', 'like', "%{$query}%");
                }
            })->paginate(10);

        return view('productos.index', compact('productos', 'query'));
        $productos = $this->productoRepository->obtenerTodos();
    }

    public function create()
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('productos.create', compact('categorias', 'proveedores'));
    }

    public function store(Request $request)
    {
        try {

            $datos = $request->validate([
                'nombre' => 'required|string|max:255',
                'codigo' => 'required|string|max:50',
                'imagen' => 'nullable|image|max:2048',
                'descripcion' => 'required|string|max:255',
                'stock' => 'required|integer|min:0',
                'precio_compra' => 'required|numeric|min:0',
                'precio_venta' => 'required|numeric|min:0',
                'id_categoria' => 'nullable|integer',
                'id_proveedor' => 'nullable|integer',
            ]);

            if ($request->hasFile('imagen')) {
                $archivo = $request->file('imagen');
                $ruta = $archivo->store('productos', 'public');

                $imagen = Imagen::create([
                    'nombre' => $archivo->getClientOriginalName(),
                    'ruta' => $ruta,
                ]);

                $datos['id_imagen'] = $imagen->id;
            }

            $this->productoRepository->crear($datos);

            return redirect()->route('productos.index')->with('success', 'Producto creado con éxito');
        } catch (Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Error al crear el producto: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $producto = $this->productoRepository->obtenerPorId($id);

        if (!$producto) {
            return redirect()->route('productos.index')->withErrors('El producto no existe.');
        }

        return view('modules.productos.show', compact('producto'));
    }

    public function edit(string $id)
    {
        $producto = $this->productoRepository->obtenerPorId($id);

        return view('productos.edit', compact('producto', 'categorias', 'proveedores'));
    }

    public function update(Request $request, string $id)
    {
        try {

            $datos = $request->validate([
                'nombre' => 'required|string|max:255',
                'codigo' => 'required|string|max:50',
                'imagen' => 'nullable|image|max:2048',
                'descripcion' => 'required|string|max:255',
                'stock' => 'required|integer|min:0',
                'precio_compra' => 'required|numeric|min:0',
                'precio_venta' => 'required|numeric|min:0',
                'id_categoria' => 'nullable|integer',
                'id_proveedor' => 'nullable|integer',
            ]);

            if ($request->hasFile('imagen')) {
                $archivo = $request->file('imagen');
                $ruta = $archivo->store('productos', 'public');

                $imagen = Imagen::create([
                    'nombre' => $archivo->getClientOriginalName(),
                    'ruta' => $ruta,
                ]);

                $datos['id_imagen'] = $imagen->id;
            }

            $this->productoRepository->actualizar($id, $datos);

            return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
        } catch (Exception $e) {
            return redirect()->route('productos.index')->with('error', 'No se pudo actualizar: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {

            $this->productoRepository->eliminar($id);
            return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
        } catch (Exception $e) {
            return redirect()->route('productos.index')->with('error', 'No se pudo eliminar el producto: ' . $e->getMessage());
        }
    }
}
