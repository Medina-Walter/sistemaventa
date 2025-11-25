<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetalleVenta;
class DetalleVentaController extends Controller
{
    //listado de detalle de ventas
    public function index(){
        $detalles = DetalleVenta::with('producto')->paginate(10);
        return view('modules.ventas.index', compact('detalles'));
    }
}
