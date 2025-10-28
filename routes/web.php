<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriasController;

Route::get('/home', function () {
    return view('modules.dashboard.home');
});

Route::get('/login', function(){
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


Route::resource('productos', ProductosController::class);


Route::resource('categorias', CategoriasController::class);
