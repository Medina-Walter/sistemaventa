@extends('layouts.main')

@section('titulo', 'Editar Categoría')

@section('contenido')
<main id="main" class="main">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow">
          <div class="card-header fw-bold text-center">Editar categoría</div>

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

            <form method="POST" action="{{ route('categorias.update', $categoria->id) }}">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label class="form-label">Nombre de categoría</label>
                <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $categoria->nombre) }}" required>
              </div>

              <div class="d-flex justify-content-between">
                <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Actualizar categoría</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
