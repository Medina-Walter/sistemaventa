<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Repositories\CarritoRepository;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    protected $carritoRepo;

    public function __construct(CarritoRepository $carritoRepo)
    {
        $this->carritoRepo = $carritoRepo;
    }

    public function index()
    {
        $carrito = $this->carritoRepo->obtenerCarrito();
        $total = $this->carritoRepo->total();

        return view('modules.carrito.index', compact('carrito', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_producto' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1'
        ]);

        $producto = Producto::findOrFail($request->id_producto);

        if ($request->cantidad > $producto->stock) {
            return back()->with('error', 'No hay stock suficiente.');
        }

        $this->carritoRepo->agregarProducto($producto, $request->cantidad);

        return redirect()->route('carrito.index')->with('success', 'Producto añadido al carrito.');
    }

    public function update(Request $request, $id)
    {
        $request->validate(['cantidad' => 'required|integer|min:1']);

        $producto = Producto::findOrFail($id);

        if ($request->cantidad > $producto->stock) {
            return back()->with('error', 'La cantidad supera el stock disponible.');
        }

        $this->carritoRepo->actualizarCantidad($id, $request->cantidad);

        return back()->with('success', 'Cantidad actualizada.');
    }

    public function destroy($id)
    {
        $this->carritoRepo->eliminarProducto($id);

        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }

    public function vaciar()
    {
        $this->carritoRepo->vaciarCarrito();

        return redirect()->route('carrito.index')->with('success', 'Carrito vaciado.');
    }
}
