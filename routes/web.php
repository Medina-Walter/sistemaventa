<?php

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Middleware\CheckUsuarioAutenticado;
use App\Http\Controllers\CategoriasController;

Route::middleware(CheckUsuarioAutenticado::class)->group(function () {

    // Rutas para editar usuario
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');

    // Rutas para cambiar contraseña
    Route::get('/usuarios/{id}/password', [UsuarioController::class, 'editPassword'])->name('usuarios.password.edit');
    Route::put('/usuarios/{id}/password', [UsuarioController::class, 'updatePassword'])->name('usuarios.password.update');

    // CRUD de productos
    

    // CRUD de categorías
    
});

// Formulario de login
Route::get('/login', function () { 
    return view('auth.login');
})->name('login');

// Procesamiento del login
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('productos', ProductosController::class);
Route::resource('categorias', CategoriasController::class);
Route::get('/home', function () {
        return view('modules.dashboard.home');
    });

    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'cambiarEstadoUsuario'])->name('usuarios.cambiarEstadoUsuario');
