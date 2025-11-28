<?php

namespace App\Providers;

use App\Models\Usuario;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::define('ver-admin', function(Usuario $user){
            return $user->rol === 'admin';
        });

        Gate::define('ver-ventas', function(Usuario $user){
            return in_array($user->rol, ['admin', 'cajero']);
        });
    }
}
