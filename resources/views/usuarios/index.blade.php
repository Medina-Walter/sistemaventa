@extends('layouts.main')

@section('titulo', 'Listado de Usuarios')

@section('contenido')
<main id="main" class="main">
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="fw-bold">Usuarios registrados</h2>
    </div>

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
      </div>
    @endif

    <div class="card shadow">
      <div class="card-body">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark text-center">
            <tr>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Usuario</th>
              <th>Rol</th>
              <th>Contraseña</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($usuarios as $usuario)
              <tr>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->apellido }}</td>
                <td>{{ $usuario->usuario }}</td>
                <td>{{ ucfirst($usuario->rol) }}</td>
                <td class="text-muted">••••••••</td>
                <td class="text-center">
                  <form method="POST" action="{{ route('usuarios.toggleEstado', $usuario) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-sm {{ $usuario->estado ? 'btn-danger' : 'btn-success' }}">
                      {{ $usuario->estado ? 'Desactivar' : 'Activar' }}
                    </button>
                  </form>
                </td>
                <td class="text-center">
                  <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="btn btn-sm btn-primary me-1">Editar</a>
                  <a href="{{ route('usuarios.editPassword', $usuario->id_usuario) }}" class="btn btn-sm btn-warning">Cambiar contraseña</a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
          {{ $usuarios->links('vendor.pagination.bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
