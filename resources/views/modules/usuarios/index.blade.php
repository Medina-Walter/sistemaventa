@extends('layouts.main')
@section('titulo', 'Panel de usuarios')
@section('contenido')

<main id="main" class="main">

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bienvenido, {{ session('usuario_nombre') }}</h5>

                        <!-- Mensajes de éxito o error -->
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i> Usuarios registrados</h5>
                            <a href="{{ route('usuarios.create') }}" class="btn btn-light text-primary fw-bold">
                                <i class="bi bi-person-plus-fill me-1"></i> Agregar Nuevo Usuario
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Usuario</th>
                                        <th>Rol</th>
                                        <th>Correo</th>
                                        <th>Contraseña</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle text-center">
                                    @forelse ($usuarios as $usuario)
                                        <tr>
                                            <td>{{ $usuario->nombre }}</td>
                                            <td>{{ $usuario->apellido }}</td>
                                            <td>{{ $usuario->usuario }}</td>
                                            <td>{{ $usuario->rol }}</td>
                                            <td>{{ $usuario->correo }}</td>
                                            <td>••••••••</td>
                                            <td>
                                                <form method="POST"
                                                    action="{{ route('usuarios.cambiarEstadoUsuario', $usuario->id_usuario) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit"
                                                        class="btn btn-sm {{ $usuario->estado ? 'btn-danger' : 'btn-success' }}">
                                                        <i class="bi {{ $usuario->estado ? 'bi-person-x' : 'bi-person-check' }}"></i>
                                                        {{ $usuario->estado ? 'Desactivar' : 'Activar' }}
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}"
                                                        class="btn btn-sm btn-primary">
                                                        <i class="bi bi-pencil-square"></i> Editar
                                                    </a>
                                                    <a href="{{ route('usuarios.password.edit', $usuario->id_usuario) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <i class="bi bi-key-fill"></i> Cambiar contraseña
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No hay usuarios registrados.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación estilo Bootstrap 5 -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $usuarios->links('vendor.pagination.bootstrap-5') }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
