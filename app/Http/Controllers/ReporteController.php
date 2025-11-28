<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Barryvdh\DomPDF\Facade\Pdf;

class ReporteController extends Controller
{
    public function index()
    {
        $umbralStock = 5;

        // 1) Bajo stock
        $bajoStock = Producto::select('codigo','nombre','stock')
            ->where('stock', '<', $umbralStock)
            ->orderBy('stock')
            ->get();

        // 2) Ventas de hoy
        $ventasHoy = Venta::whereDate('created_at', now())->sum('total_venta');

        // 3) Total ventas
        $totalVentas = Venta::sum('total_venta');

        // 4) Producto más vendido
        $productoMasVendido = DetalleVenta::select('id_producto', DB::raw('SUM(cantidad) as total_cantidad'))
            ->groupBy('id_producto')
            ->orderBy('total_cantidad', 'desc')
            ->with('producto:id_producto,codigo,nombre')
            ->first();

        $productoMasVendidoCard = null;
        if ($productoMasVendido) {
            $productoMasVendidoCard = (object)[
                'nombre'   => $productoMasVendido->producto ? $productoMasVendido->producto->nombre : '',
                'codigo'   => $productoMasVendido->producto ? $productoMasVendido->producto->codigo : '',
                'cantidad' => $productoMasVendido->total_cantidad,
            ];
        }

        // 5) Ventas por mes (últimos 12)
        $ventasPorMes = Venta::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as periodo'),
                DB::raw('SUM(total_venta) as total')
            )
            ->groupBy('periodo')
            ->orderBy('periodo')
            ->limit(12)
            ->get();

        $labels = $ventasPorMes->pluck('periodo')->toArray();
        $data   = $ventasPorMes->pluck('total')->toArray();

        return view('modules.reportes.reportes', [
            'bajoStock'              => $bajoStock,
            'ventasHoy'              => $ventasHoy,
            'totalVentas'            => $totalVentas,
            'productoMasVendidoCard' => $productoMasVendidoCard,
            'ventasPorMes'           => $ventasPorMes,
            'labels'                 => $labels,
            'data'                   => $data,
            'umbralStock'            => $umbralStock,
        ]);
    }

    /**
     * Vista separada para últimos productos vendidos
     */
    

    /**
     * Exportar reportes a PDF
     */
    public function exportarPdf()
    {
        // Ejemplo simple: exportar todas las ventas
        $ventas = Venta::select('id_venta','created_at','total_venta')->get();

        // Renderiza la vista Blade "reportes_pdf.blade.php"
        $pdf = Pdf::loadView('modules.reportes.reportes_pdf', compact('ventas'));

        // Descarga el archivo
        return $pdf->download('reportes.pdf');
    }
}
