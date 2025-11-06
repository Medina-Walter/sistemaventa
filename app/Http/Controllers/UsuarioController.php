<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::paginate(10);
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'usuario' => 'required|string|max:50|unique:usuarios,usuario',
            'correo' => 'required|email|unique:usuarios,correo',
            'password' => 'required|string|min:8|confirmed',
            'rol' => 'required|in:admin,empleado',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'usuario' => $request->usuario,
            'correo' => $request->correo,
            'password' => Hash::make($request->password),
            'rol' => $request->rol,
            'estado' => true,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function cambiarEstadoUsuario($id)
    {
        $usuario->estado = !$usuario->estado;
        $usuario->save();

        return back()->with('success', 'Estado actualizado correctamente.');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'usuario' => 'required|string|max:50',
            'rol' => 'required|in:admin,empleado',
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->only(['nombre', 'apellido', 'usuario', 'rol']));

        return redirect('/home')->with('success', 'Usuario actualizado correctamente.');
    }

    public function editPassword($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.password', compact('usuario'));
    }

    public function updatePassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $usuario = Usuario::findOrFail($id);
        $usuario->password = Hash::make($request->password);
        $usuario->save();

        return redirect('/home')->with('success', 'Contraseña actualizada correctamente.');
    }
}
