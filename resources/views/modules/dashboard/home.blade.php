@extends('layouts.main')
@section('titulo')
@section('contenido')
  <main id="main" class="main">

    <div class="pagetitle flex justify-between items-center">
      <h1>Dashboard</h1>
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
          Cerrar sesión
        </button>
      </form>
    </div>

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Bienvenido, {{ session('usuario_nombre') }}</h5>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
