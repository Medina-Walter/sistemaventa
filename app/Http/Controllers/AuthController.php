<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'correo' => ['required', 'email'],
            'password' => ['required']
        ]);

        $usuario = $this->userRepository->buscarUsuarioPorCorreo($credenciales['correo']);

        if (!$usuario) {
            return back()->withErrors(['correo' => 'El usuario no existe']);
        }

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }

        return back()->withErrors(['password' => 'Credenciales Incorrectas']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
