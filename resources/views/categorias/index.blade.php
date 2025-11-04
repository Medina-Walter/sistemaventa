@extends('layouts.main')

@section('titulo', 'Listado de Categorías')

@section('contenido')
<main id="main" class="main">
  <div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Categorías</h2>
    </div>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow">
      <div class="card-body">
        <table class="table table-bordered table-hover">
          <thead class="table-light">
            <tr>
              <th>Nombre de categoría</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($categorias as $categoria)
              <tr>
                <td>{{ $categoria->nombre }}</td>
                <td class="d-flex gap-2">
                  <a href="{{ route('categorias.edit', $categoria->id_categoria) }}" class="btn btn-sm btn-primary">Editar</a>
                  <form method="POST" action="{{ route('categorias.destroy', $categoria->id_categoria) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar categoría?')">Eliminar</button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="2" class="text-center">No hay categorías registradas.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>
@endsection
