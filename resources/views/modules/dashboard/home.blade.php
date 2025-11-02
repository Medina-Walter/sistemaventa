@extends('layouts.main')
@section('titulo')
@section('contenido')
  <main id="main" class="main">

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
