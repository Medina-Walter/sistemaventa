@extends('layouts.main')

@section('titulo', 'Registrar Proveedor')

@section('contenido')
<main id="main" class="main">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow">
          <div class="card-header fw-bold text-center">Registrar nuevo proveedor</div>

          <div class="card-body">
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            <form method="POST" action="{{ route('proveedores.store') }}">
              @csrf

              <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control">
              </div>

              <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control">
              </div>

              <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control">
              </div>

              <div class="mb-3">
                <label class="form-label">Sitio web</label>
                <input type="text" name="sitio_web" class="form-control">
              </div>

              <div class="mb-3">
                <label class="form-label">Nota</label>
                <textarea name="nota" class="form-control" rows="3"></textarea>
              </div>

              <button type="submit" class="btn btn-primary w-100">Registrar proveedor</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
