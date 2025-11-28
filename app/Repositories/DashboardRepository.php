<?php

namespace App\Repositories;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRepository
{

    public function ventasHoy()
    {
        // Obtener las ventas del día
        $ventasHoy = Venta::whereDate('created_at', Carbon::today())->pluck('id');

        // Sumar todas las cantidades de los detalles de esas ventas
        return DetalleVenta::whereIn('id_venta', $ventasHoy)->sum('cantidad');
    }

    public function ventasMes()
    {
        return DetalleVenta::whereMonth('created_at', now()->month)
            ->sum('cantidad');
    }


    public function totalVentas()
    {
        return Venta::sum('total_venta');
    }


    public function bajoStock($limite = 5)
    {
        return Producto::where('stock', '<=', $limite)->get();
    }

    public function productoMasVendido()
    {
        $detalle = DetalleVenta::select('id_producto', DB::raw('SUM(cantidad) as total'))
            ->groupBy('id_producto')
            ->orderByDesc('total')
            ->first();

        if ($detalle) {
            $producto = Producto::find($detalle->id_producto);
            if ($producto) {
                $producto->cantidad = $detalle->total;
                return $producto;
            }
        }

        return null; // Si no hay ventas
    }


    public function ultimasVentas($limite = 5)
    {
        return Venta::latest()->take($limite)->get();
    }
}
