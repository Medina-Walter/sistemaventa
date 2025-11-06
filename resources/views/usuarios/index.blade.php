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
=======
@section('titulo', 'Panel de usuarios')
@section('contenido')

<main id="main" class="main">

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bienvenido, {{ session('usuario_nombre') }}</h5>
                        <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i> Usuarios registrados</h5>
                            <a href="{{ route('usuarios.create') }}" class="btn btn-light text-primary fw-bold">
                            <i class="bi bi-person-plus-fill me-1"></i> Agregar Nuevo Usuario</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="table-light text-center">
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
                                <tbody class="align-middle text-center">
                                @foreach ($usuarios as $usuario)
                                    <tr>
                                        <td>{{ $usuario->nombre }}</td>
                                        <td>{{ $usuario->apellido }}</td>
                                        <td>{{ $usuario->usuario }}</td>
                                        <td>{{ $usuario->rol }}</td>
                                        <td>••••••••</td>
                                        <td>
                                            <form method="POST" action="{{ route("usuarios.cambiarEstadoUsuario", $usuario->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm {{ $usuario->estado ? 'btn-danger' : 'btn-success' }}">
                                                    <i class="bi {{ $usuario->estado ? 'bi-person-x' : 'bi-person-check' }}"></i>
                                                    {{ $usuario->estado ? 'Desactivar' : 'Activar' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-pencil-square"></i> Editar
                                                </a>
                                                <a href="{{ route('usuarios.password.edit', $usuario->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-key-fill"></i> Cambiar contraseña
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                           </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection

