@extends('layouts.main')

@section('titulo', 'Editar Usuario')

@section('contenido')
    <main id="main" class="main">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-header fw-bold text-center">Editar usuario</div>

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

                            <form method="POST" action="{{ route('usuarios.update', $usuario->id_usuario) }}">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" name="nombre" value="{{ old('nombre', $usuario->nombre) }}"
                                            class="form-control" required>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Apellido</label>
                                        <input type="text" name="apellido"
                                            value="{{ old('apellido', $usuario->apellido) }}" class="form-control">
                                    </div>

                                    <div class="mt-3">
                                        <label class="form-label">Usuario</label>
                                        <input type="text" name="usuario" value="{{ old('usuario', $usuario->usuario) }}"
                                            class="form-control" required>
                                    </div>

                                    <div class="col mt-3">
                                        <label class="form-label">Correo</label>
                                        <input type="email" name="correo" value="{{ old('correo', $usuario->correo) }}"
                                            class="form-control" required>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <label class="form-label">Rol</label>
                                    <select name="rol" class="form-select" required>
                                        <option value="admin" {{ $usuario->rol === 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="empleado" {{ $usuario->rol === 'empleado' ? 'selected' : '' }}>
                                            Empleado</option>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-between mt-3">
                                    <a href="{{ route('usuarios.index') }}" class="btn btn-primary">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
