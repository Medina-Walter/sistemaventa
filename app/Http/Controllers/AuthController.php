<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        $usuario = Usuario::where('usuario', $request->usuario)->first();

        if ($usuario && Hash::check($request->password, $usuario->password)) {
            Session::put('id', $usuario->id);
            Session::put('nombre', $usuario->nombre);

            return redirect('/home');
        }

        return back()->withErrors(['usuario' => 'Credenciales incorrectas.',])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}
