<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\UsuarioController;
use App\Http\Middleware\CheckUsuarioAutenticado;

// Grupo de rutas protegidas por sesión
Route::middleware(CheckUsuarioAutenticado::class)->group(function () {

    // Dashboard principal
    Route::get('/home', function () {
        return view('modules.dashboard.home');
    });

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;


    // Panel de usuarios
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::put('/usuarios/{id}/toggle', [UsuarioController::class, 'toggleEstado'])->name('usuarios.toggle');

    // Rutas para editar usuario
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');

    // Rutas para cambiar contraseña
    Route::get('/usuarios/{id}/password', [UsuarioController::class, 'editPassword'])->name('usuarios.password.edit');
    Route::put('/usuarios/{id}/password', [UsuarioController::class, 'updatePassword'])->name('usuarios.password.update');

    // CRUD de productos
    Route::resource('productos', ProductosController::class);
});

// Formulario de login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Procesamiento del login
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('productos', ProductosController::class);

Route::resource('categorias', CategoriasController::class);

