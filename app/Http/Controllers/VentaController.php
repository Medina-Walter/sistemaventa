<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Repositories\CarritoRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    protected $carrito;

    public function __construct(CarritoRepository $carrito)
    {
        $this->carrito = $carrito;
    }

    public function confirmarVenta()
    {
        $carrito = $this->carrito->obtenerCarrito();

        if (empty($carrito)) {
            return back()->with('error', 'El carrito está vacío.');
        }

        DB::beginTransaction();

        try {

            // Crear venta
            $venta = Venta::create([
                'id_usuario'  => Auth::id(),
                'fecha_venta' => now(),
                'monto_total' => $this->carrito->total()
            ]);

            // Descontar stock y crear detalle
            foreach ($carrito as $item) {

                $producto = Producto::findOrFail($item['id']);

                if ($producto->stock < $item['cantidad']) {
                    DB::rollBack();
                    return back()->with('error', "Stock insuficiente para: {$producto->nombre}");
                }

                // Descontar stock
                $producto->stock -= $item['cantidad'];
                $producto->save();

                // Crear detalle de la venta
                DetalleVenta::create([
                    'id_venta'       => $venta->id,
                    'id_producto'    => $item['id'],
                    'cantidad'       => $item['cantidad'],
                    'precio_unitario'=> $item['precio_venta'],
                    'sub_total'      => $item['subtotal']
                ]);
            }

            DB::commit();

            $this->carrito->vaciarCarrito();

            return redirect()->route('carrito.index')
                ->with('success', 'Venta realizada con éxito.');

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
