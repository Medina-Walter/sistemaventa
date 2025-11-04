@extends('layouts.main')

@section('titulo', 'Registrar Usuario')

@section('contenido')
<main id="main" class="main">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card shadow">
          <div class="card-header fw-bold text-center">Registrar nuevo usuario</div>

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

            <form method="POST" action="{{ route('usuarios.store') }}">
              @csrf

              <div class="row mb-3">
                <div class="col">
                  <label class="form-label">Nombre</label>
                  <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="col">
                  <label class="form-label">Apellido</label>
                  <input type="text" name="apellido" class="form-control" required>
                </div>
              </div>

              <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" name="correo" class="form-control" required>
              </div>

              <div class="row mb-3">
                <div class="col">
                  <label class="form-label">Contraseña</label>
                  <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col">
                  <label class="form-label">Confirmar contraseña</label>
                  <input type="password" name="password_confirmation" class="form-control" required>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col">
                  <label class="form-label">Rol</label>
                  <select name="rol" class="form-select" required>
                    <option value="">Seleccionar</option>
                    <option value="admin">Admin</option>
                    <option value="empleado">Empleado</option>
                  </select>
                </div>
                <div class="col">
                  <label class="form-label">Estado</label>
                  <select name="estado" class="form-select" required>
                    <option value="">Seleccionar</option>
                    <option value="activo">Activo</option>
                    <option value="inactivo">Inactivo</option>
                  </select>
                </div>
              </div>

              <button type="submit" class="btn btn-primary w-100">Registrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
