<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Repositories\CarritoRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class VentaController extends Controller
{
    protected $carrito;

    public function __construct(CarritoRepository $carrito)
    {
        $this->carrito = $carrito;
    }

    public function index()
    {
        $titulo = 'Ventas Realizadas';
        $ventas = Venta::with('usuario')->paginate(10);
        return view('modules.ventas.index', compact('ventas', 'titulo'));
    }

    public function show($id)
    {
        $venta = Venta::with('detalles', 'usuario')->findOrFail($id);
        return view('modules.ventas.detalles-ventas', compact('venta'));
    }

    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        return view('modules.ventas.edit', compact('venta'));
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
                'id_usuario'  => auth()->user()->id,
                'fecha_venta' => now(),
                'total_venta' => $this->carrito->total()
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
                    'precio_unitario' => $item['precio_venta'],
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

    public function ticket($id)
    {
        $venta = Venta::with('detalles.producto', 'usuario')->findOrFail($id);
        $pdf = Pdf::loadView('modules.ventas.ticket', compact('venta'));
        return $pdf->download('reportes.pdf');
    }

    public function anular($id)
    {
        $venta = Venta::with('detalles')->findOrFail($id);

        if ($venta->estado === 'anulada') {
            return back()->with('error', 'La venta ya está anulada.');
        }

        DB::beginTransaction();

        try {
            foreach ($venta->detalles as $detalle) {
                $producto = $detalle->producto;
                $producto->stock += $detalle->cantidad;
                $producto->save();
            }

            $venta->estado = 'anulada';
            $venta->save();

            DB::commit();
            return back()->with('success', 'Venta anulada correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al anular la venta: ' . $e->getMessage());
        }
    }

    public function activar($id)
    {
        $venta = Venta::findOrFail($id);

        if ($venta->estado === 'activa') {
            return back()->with('error', 'La venta ya está activa.');
        }

        $venta->estado = 'activa';
        $venta->save();

        return back()->with('success', 'Venta activada correctamente.');
    }
}
