<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = Carrito::paginate(10);
        return view('modules.carrito.index', compact('carrito'));
    }

    public function edit($id)
    {
        $item = Carrito::findOrFail($id);
        return view('modules.carrito.edit', compact('item'));
    }

    public function destroy($id)
    {
        $item = Carrito::findOrFail($id);
        $item->delete();
        return redirect()->route('carrito.index')->with('success', 'Producto eliminado del carrito.');
    }
}
