<?php

namespace App\Http\Controllers;

use App\Repositories\DashboardRepository;

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
            'productosBajoStock' => $this->repo->productosBajoStock(),
            'productoMasVendido' => $this->repo->productoMasVendido(),
            'ventasPorMes'     => $this->repo->ventasPorMes(),
            'ultimasVentas'    => $this->repo->ultimasVentas()
        ]);
    }
}
