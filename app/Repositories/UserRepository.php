<?php

namespace App\Repositories;

use App\Models\Usuario;

class UserRepository
{
    public function buscarUsuarioPorCorreo(string $correo)
    {
        return Usuario::where('correo', $correo)->first();
    }

    public function verificarUsuario(string $correo)
    {
        return Usuario::where('correo', $correo)->exists();
    }
}
