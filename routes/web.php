<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\CarritoController;

Route::middleware(['web'])->group(function () {

    Route::middleware(['auth', 'can:ver-admin'])->group(function () {

        Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
        Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
        Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
        Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::put('/usuarios/{id}/estado', [UsuarioController::class, 'cambiarEstadoUsuario'])->name('usuarios.cambiarEstadoUsuario');
        Route::get('/usuarios/{id}/password', [UsuarioController::class, 'editPassword'])->name('usuarios.password.edit');
        Route::put('/usuarios/{id}/update/password', [UsuarioController::class, 'updatePassword'])->name('usuarios.password.update');
    });


    Route::middleware(['auth'])->group(function () {

        Route::get('/productos', [ProductosController::class, 'index'])->name('productos.index');
        Route::get('/productos/create', [ProductosController::class, 'create'])->name('productos.create');
        Route::post('/productos', [ProductosController::class, 'store'])->name('productos.store');
        Route::get('/productos/{id}/edit', [ProductosController::class, 'edit'])->name('productos.edit');
        Route::put('/productos/{id}', [ProductosController::class, 'update'])->name('productos.update');
        Route::delete('/productos/{id}', [ProductosController::class, 'destroy'])->name('productos.destroy');

        Route::get('/proveedores', [ProveedorController::class, 'index'])->name('proveedores.index');
        Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
        Route::post('/proveedores', [ProveedorController::class, 'store'])->name('proveedores.store');
        Route::get('/proveedores/{id}/edit', [ProveedorController::class, 'edit'])->name('proveedores.edit');
        Route::put('/proveedores/{id}', [ProveedorController::class, 'update'])->name('proveedores.update');
        Route::delete('/proveedores/{id}', [ProveedorController::class, 'destroy'])->name('proveedores.destroy');

        Route::get('/categorias', [CategoriasController::class, 'index'])->name('categorias.index');
        Route::get('/categorias/create', [CategoriasController::class, 'create'])->name('categorias.create');
        Route::post('/categorias', [CategoriasController::class, 'store'])->name('categorias.store');
        Route::get('/categorias/{id}/edit', [CategoriasController::class, 'edit'])->name('categorias.edit');
        Route::put('/categorias/{id}', [CategoriasController::class, 'update'])->name('categorias.update');
        Route::delete('/categorias/{id}', [CategoriasController::class, 'destroy'])->name('categorias.destroy');

        Route::get('/detalle-venta', [DetalleVentaController::class, 'index'])->name('detalle_venta.index');

        Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
        Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');
        Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
        Route::get('/carrito/{id}/edit', [CarritoController::class, 'edit'])->name('carrito.edit');
        Route::delete('/carrito/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
        Route::delete('/carrito/{id}', [CarritoController::class, 'destroy'])->name('carrito.destroy');

        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::get('/reportes', [DashboardController::class, 'index'])->name('reportes.index');
        Route::get('/reportes/ultimos', [DashboardController::class, 'ultimos'])->name('reportes.ultimos');
        Route::get('/reportes/exportar-pdf', [DashboardController::class, 'exportarPdf'])->name('reportes.exportarPdf');

        Route::get('/ventas', [VentaController::class, 'index'])->name('ventas.index');
        Route::get('/ventas/{id}', [VentaController::class, 'show'])->name('ventas.show');
        Route::get('/ventas/{id}/edit', [VentaController::class, 'edit'])->name('ventas.edit');
        Route::put('/ventas/{id}', [VentaController::class, 'update'])->name('ventas.update');
        Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->name('ventas.destroy');
        Route::get('/ventas/{id}/ticket', [VentaController::class, 'ticket'])->name('ventas.ticket');
        Route::post('/ventas/confirmar', [VentaController::class, 'confirmarVenta'])->name('ventas.confirmar');
        Route::post('/ventas/{id}/anular', [VentaController::class, 'anular'])->name('ventas.anular');
        Route::post('/ventas/{id}/activar', [VentaController::class, 'activar'])->name('ventas.activar');
    });
});

// Login
Route::get('/login', fn() => view('auth.login'))->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
