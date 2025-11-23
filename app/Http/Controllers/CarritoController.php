<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CarritoRepository;
use App\Models\Producto;

class CarritoController extends Controller
{
    protected $carrito;

    public function __construct(CarritoRepository $carrito)
    {
        $this->carrito = $carrito;
    }

    public function index()
    {
        $carrito = $this->carrito->obtenerCarrito();
        $total = $this->carrito->total();

        return view('modules.carrito.index', compact('carrito', 'total'));
    }

    public function agregar(Request $request)
    {
        $producto = Producto::findOrFail($request->id);

        $this->carrito->agregarProducto($producto, $request->cantidad);

        return redirect()->route('carrito.index')
            ->with('success', 'Producto añadido al carrito');
    }

    public function actualizar(Request $request)
    {
        $this->carrito->actualizarCantidad($request->id, $request->cantidad);

        return back()->with('success', 'Cantidad actualizada');
    }

    public function eliminar($id)
    {
        $this->carrito->eliminarProducto($id);

        return back()->with('success', 'Producto eliminado');
    }

    public function vaciar()
    {
        $this->carrito->vaciarCarrito();

        return back()->with('success', 'Carrito vacío');
    }
}

