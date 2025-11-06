<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Muestra el formulario de login
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesa el intento de login
     */
    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::where('usuario', $request->usuario)->first();

        if ($usuario && Hash::check($request->password, $usuario->password)) {

            if (!$usuario->estado) {
                return back()->withErrors([
                    'usuario' => 'Este usuario está inactivo.',
                ])->withInput();
            }

            Session::put('usuario_id', $usuario->id);
            Session::put('usuario_nombre', $usuario->nombre . ' ' . $usuario->apellido);
            Session::put('usuario_rol', $usuario->rol);
            Session::put('id', $usuario->id);
            Session::put('nombre', $usuario->nombre);

            return redirect('/home');
        }

        return back()->withErrors(['usuario' => 'Credenciales incorrectas.',])->withInput();
    }

    /**
     * Cierra la sesión
     */
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}
