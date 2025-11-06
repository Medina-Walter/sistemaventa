@extends('layouts.main')

@section('titulo', 'Registrar Usuario')

@section('contenido')

<main id="main" class="main">

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header bg-gradient bg-primary text-white text-center">
                    <h5 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i> Registro de nuevo usuario</h5>
            </div>
            <div class="card-body">
              <h5 class="card-title">Bienvenido, {{ session('usuario_nombre') }}</h5>
              @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('usuarios.store') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required value="{{ old('nombre') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" name="apellido" id="apellido" class="form-control" required value="{{ old('apellido') }}">
                            </div>

              <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control" required>
              </div>

              <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" name="correo" class="form-control" required>
              </div>
                            <div class="col-md-6">
                                <label for="rol" class="form-label">Rol</label>
                                <select name="rol" id="rol" class="form-select" required>
                                    <option value="admin" {{ old('rol') == 'admin' ? 'selected' : '' }}>Administrador</option>
                                    <option value="usuario" {{ old('rol') == 'usuario' ? 'selected' : '' }}>Usuario</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <button type="submit" class="btn btn-success me-2">
                                <i class="bi bi-check-circle me-1"></i> Registrar usuario
                            </button>
                            <a href="{{ route('usuarios.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left-circle me-1"></i> Cancelar
                            </a>
                        </div>
                    </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection
