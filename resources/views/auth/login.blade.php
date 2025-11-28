@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center">
    <div class="col-md-6">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header text-center bg-primary text-white fw-bold fs-4">
                <i class="bi bi-person-circle me-2"></i> Iniciar sesión
            </div>

            <div class="card-body p-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="usuario" class="form-label fw-semibold">
                            <i class="bi bi-person-fill me-1"></i> Usuario
                        </label>
                        <input type="text" name="usuario" id="usuario" value="{{ old('usuario') }}"
                            class="form-control border-primary shadow-sm" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            <i class="bi bi-lock-fill me-1"></i> Contraseña
                        </label>
                        <input type="password" name="password" id="password"
                            class="form-control border-primary shadow-sm" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Ingresar
                    </button>
                </form>
            </div>

            <div class="card-footer text-center bg-light">
                <small class="text-muted">© {{ date('Y') }} Sistema de Ventas</small>
            </div>
        </div>
    </div>
</div>
@endsection
