<?php

use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\VentaController;
use App\Http\Middleware\CheckUsuarioAutenticado;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\CarritoController;
use App\Models\Carrito;
use App\Http\Controllers\VentaController;
use Symfony\Component\Routing\Route as RoutingRoute;
use App\Http\Controllers\ReporteController;


Route::middleware(CheckUsuarioAutenticado::class)->group(function () {

});

Route::get('/login', function () { 
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/home', function () { return view('modules.dashboard.home');})->name('home');

Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
Route::put('/usuarios/{id}/estado', [UsuarioController::class, 'cambiarEstadoUsuario'])->name('usuarios.cambiarEstadoUsuario');
Route::get('/usuarios/{id}/password', [UsuarioController::class, 'editPassword'])->name('usuarios.password.edit');
Route::put('/usuarios/{id}/update/password', [UsuarioController::class, 'updatePassword'])->name('usuarios.password.update');


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
Route::get('ventas/{id}/ticket', [VentaController::class, 'ticket'])->name('ventas.ticket');
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::put('/carrito/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::delete('/carrito/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::delete('/carrito', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');

Route::post('/ventas/confirmar', [VentaController::class, 'confirmarVenta'])->name('ventas.confirmar');

//repores
Route::get('/reportes', [ReporteController::class, 'index'])->name('reportes.index');
Route::get('/reportes/ultimos', [ReporteController::class, 'ultimos'])->name('reportes.ultimos');
Route::get('/reportes/exportar-pdf', [ReporteController::class, 'exportarPdf'])
     ->name('reportes.exportarPdf');
