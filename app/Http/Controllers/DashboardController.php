<?php

namespace App\Http\Controllers;

use App\Models\DetalleVenta;
use App\Models\Venta;
use App\Repositories\DashboardRepository;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    protected $repo;

    public function __construct(DashboardRepository $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return view('modules.dashboard.home', [
            'ventasHoy'        => $this->repo->ventasHoy(),
            'ventasMes'        => $this->repo->ventasMes(),
            'totalVentas'      => $this->repo->totalVentas(),
            'bajoStock'        => $this->repo->bajoStock(),
            'productoMasVendido' => $this->repo->productoMasVendido(),
            'ultimasVentas'    => $this->repo->ultimasVentas()
        ]);
    }

    public function exportarPdf()
    {
        $ventas = Venta::with(['detalleVenta', 'usuario'])
            ->select('id', 'created_at', 'total_venta', 'estado', 'id_usuario')
            ->get();
            return Pdf::loadView('modules.reportes.reportes_pdf', compact('ventas'))->stream();
    }


    public function ultimos()
    {
        $ultimosVendidos = DetalleVenta::select('detalle_venta.*')
            ->join('ventas', 'ventas.id', '=', 'detalle_venta.id_venta')
            ->orderBy('ventas.created_at', 'desc')
            ->with(['producto:id,codigo,nombre', 'venta:id,created_at,total_venta'])
            ->limit(10)
            ->get();

        return view('modules.reportes.ultimos', compact('ultimosVendidos'));
    }
}
