<?php

namespace App\Http\Controllers;

use App\Repositories\ProveedorRepository;
use Illuminate\Http\Request;
use Exception;

class ProveedoresController extends Controller
{
    protected $proveedorRepository;

    public function __construct(ProveedorRepository $proveedorRepository)
    {
        $this->proveedorRepository = $proveedorRepository;
    }

    public function index()
    {
        $proveedores = $this->proveedorRepository->obtenerTodos();
        return view('modules.proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        return view('modules.proveedores.create');
    }

    public function store(Request $request)
    {
        try {
            $datos = $request->validate([
                'nombre' => 'required|string|max:255',
                'telefono' => 'nullable|string|max:50',
                'email' => 'nullable|email|max:255',
                'direccion' => 'nullable|string|max:255',
                'sitio_web' => 'nullable|url|max:255',
                'nota' => 'nullable|string|max:500',
            ]);

            $this->proveedorRepository->crear($datos);

            return redirect()->route('modules.proveedores.index')->with('success', 'Proveedor creado correctamente.');

        } catch (Exception $e) {
            return redirect()->route('modules.proveedores.index')->with('error', 'No se pudo crear el proveedor.' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $proveedor = $this->proveedorRepository->obtenerPorId($id);

        if (!$proveedor) {
            return redirect()->route('modules.proveedores.index')->withErrors("El proveedor no existe.");
        }

        return view('modules.proveedores.show', compact('proveedor'));
    }

    public function edit($id)
    {
        $proveedor = $this->proveedorRepository->obtenerPorId($id);

        if (!$proveedor) {
            return redirect()->route('modules.proveedores.index')->withErrors("El proveedor no existe.");
        }

        return view('modules.proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, $id)
    {
        try {
            $datos = $request->validate([
                'nombre' => 'required|string|max:255',
                'telefono' => 'nullable|string|max:50',
                'email' => 'nullable|email|max:255',
                'direccion' => 'nullable|string|max:255',
                'sitio_web' => 'nullable|url|max:255',
                'nota' => 'nullable|string|max:500',
            ]);

            $this->proveedorRepository->actualizar($id, $datos);

            return redirect()->route('modules.proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
        } catch (Exception $e) {
            return redirect()->route('modules.proveedores.index')->with('error', 'No se pudo actualizar el proveedor.' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->proveedorRepository->eliminar($id);
            return redirect()->route('modules.proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
        } catch (Exception $e) {
            return redirect()->route('modules.proveedores.index')->with('error', 'No se pudo eliminar el proveedor.' . $e->getMessage());
        }
    }
}
