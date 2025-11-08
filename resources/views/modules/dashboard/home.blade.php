@extends('layouts.main')

@section('titulo', 'Dashboard')

@section('contenido')
<main id="main" class="main">

  <div class="pagetitle flex justify-between items-center">
    <h1>Dashboard</h1>
  </div>

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
  @endif

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Bienvenido, {{ session('usuario_nombre') }}</h5>

            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
