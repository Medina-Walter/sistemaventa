<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    /**
     * Mostrar listado de ventas.
     */
    public function index()
    {
        // Trae las ventas con el usuario relacionado
        $ventas = Venta::with('usuario')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('modules.ventas.ventas-realizadas', compact('ventas'));
    }

    /**
     * Mostrar detalle de una venta.
     */
    public function show($id)
    {
        $venta = Venta::with(['usuario','detalles'])->findOrFail($id);
        return view('ventas.show', compact('venta'));
    }

    /**
     * Mostrar formulario de edición.
     */
    public function edit($id)
    {
        $venta = Venta::findOrFail($id);
        return view('ventas.edit', compact('venta'));
    }

    /**
     * Actualizar una venta.
     */
    public function update(Request $request, $id)
    {
        $venta = Venta::findOrFail($id);
        $venta->update($request->all());

        return redirect()->route('ventas.index')->with('status', 'Venta actualizada correctamente');
    }

    /**
     * Eliminar una venta.
     */
    public function destroy($id)
    {
        $venta = Venta::findOrFail($id);
        $venta->delete();

        return redirect()->route('ventas.index')->with('status', 'Venta eliminada correctamente');
    }

    /**
     * Generar ticket de una venta.
     */
    public function ticket($id)
    {
        $venta = Venta::with(['usuario','detalles'])->findOrFail($id);

        // Aquí puedes devolver una vista imprimible o generar PDF
        return view('ventas.ticket', compact('venta'));
    }
}
