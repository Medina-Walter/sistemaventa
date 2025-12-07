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
            })->paginate(12);

        return view('modules.productos.index', compact('productos', 'query'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();
        return view('modules.productos.create', compact('categorias', 'proveedores'));
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

            // Manejo de imagen
            if ($request->hasFile('imagen')) {
                $archivo = $request->file('imagen');
                $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();

                // Guardar directamente en public_html/storage/productos
                $rutaDestino = $_SERVER['DOCUMENT_ROOT'] . '/storage/productos';
                if (!file_exists($rutaDestino)) {
                    mkdir($rutaDestino, 0755, true);
                }

                $archivo->move($rutaDestino, $nombreArchivo);

                $imagen = Imagen::create([
                    'nombre' => $nombreArchivo,
                    'ruta' => 'storage/productos/' . $nombreArchivo, // ruta relativa para Blade
                ]);

                $datos['id_imagen'] = $imagen->id;
            }

            $this->productoRepository->crear($datos);

            return redirect()->route('productos.index')->with('success', 'Producto creado con éxito');
        } catch (Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Error al crear el producto: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $producto = $this->productoRepository->obtenerPorId($id);

        if (!$producto) {
            return redirect()->route('productos.index')->withErrors('El producto no existe.');
        }

        return view('modules.productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = $this->productoRepository->obtenerPorId($id);
        $categorias = Categoria::all();
        $proveedores = Proveedor::all();

        return view('modules.productos.edit', compact('producto', 'categorias', 'proveedores'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'codigo' => 'required|string|max:50',
            'descripcion' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'precio_compra' => 'required|numeric|min:0',
            'precio_venta' => 'required|numeric|min:0',
            'id_categoria' => 'nullable|integer',
            'id_proveedor' => 'nullable|integer',
        ]);

        // Manejo de imagen
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();

            $rutaDestino = $_SERVER['DOCUMENT_ROOT'] . '/storage/productos';
            if (!file_exists($rutaDestino)) {
                mkdir($rutaDestino, 0755, true);
            }

            $archivo->move($rutaDestino, $nombreArchivo);

            if ($producto->imagen) {
                $producto->imagen->update([
                    'nombre' => $nombreArchivo,
                    'ruta' => 'storage/productos/' . $nombreArchivo,
                ]);
                $datos['id_imagen'] = $producto->imagen->id;
            } else {
                $imagen = Imagen::create([
                    'nombre' => $nombreArchivo,
                    'ruta' => 'storage/productos/' . $nombreArchivo,
                ]);
                $datos['id_imagen'] = $imagen->id;
            }
        }

        $producto->update($datos);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }

    public function destroy($id)
    {
        try {
            $producto = $this->productoRepository->obtenerPorId($id);

            // Eliminar imagen física si existe
            if ($producto && $producto->imagen) {
                $rutaFisica = $_SERVER['DOCUMENT_ROOT'] . '/' . $producto->imagen->ruta;
                if (file_exists($rutaFisica)) {
                    unlink($rutaFisica);
                }
            }

            $this->productoRepository->eliminar($id);
            return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
        } catch (Exception $e) {
            return redirect()->route('productos.index')->with('error', 'No se pudo eliminar el producto: ' . $e->getMessage());
        }
    }
}
