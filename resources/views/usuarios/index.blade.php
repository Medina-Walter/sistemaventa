@extends('layouts.main')

@section('titulo', 'Panel de usuarios')

@section('contenido')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-11">
            <div class="card border-0 shadow-lg">
                <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i> Usuarios registrados</h5>
                    <a href="{{ route('usuarios.create') }}" class="btn btn-light text-primary fw-bold">
                        <i class="bi bi-person-plus-fill me-1"></i> Agregar Nuevo Usuario
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered datatable">
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
                                            <form method="POST" action="{{ route('usuarios.toggle', $usuario->id_usuario) }}">
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
                                                <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-pencil-square"></i> Editar
                                                </a>
                                                <a href="{{ route('usuarios.password.edit', $usuario->id_usuario) }}" class="btn btn-sm btn-primary">
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
</div>
@endsection
