<?php

namespace App\Repositories;

use App\Models\Usuario;
use Illuminate\Foundation\Auth\User;

class UserRepository
{
    public function buscarUsuarioPorCorreo(string $correo)
    {
        return User::where('correo', $correo)->first();
    }

    public function verificarUsuario(string $correo)
    {
        return User::where('correo', $correo)->exists();
    }



}