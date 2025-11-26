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
        return Venta::whereDate('created_at', Carbon::today())->sum('monto_total');
    }

    public function ventasMes()
    {
        return Venta::whereMonth('created_at', Carbon::now()->month)->sum('monto_total');
    }

    public function totalVentas()
    {
        return Venta::count();
    }

    public function productosBajoStock($limite = 5)
    {
        return Producto::where('stock', '<=', $limite)->get();
    }

    public function productoMasVendido()
    {
        return DetalleVenta::select('id_producto', DB::raw('SUM(cantidad) as total'))
            ->groupBy('id_producto')
            ->orderByDesc('total')
            ->first();
    }

    public function ventasPorMes()
    {
        return Venta::select(
            DB::raw('MONTH(created_at) as mes'),
            DB::raw('SUM(monto_total) as total')
        )
        ->groupBy('mes')
        ->orderBy('mes')
        ->get();
    }

    public function ultimasVentas($limite = 5)
    {
        return Venta::latest()->take($limite)->get();
    }
}
