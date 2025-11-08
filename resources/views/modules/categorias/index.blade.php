@extends('layouts.main')
@section('titulo', 'Categorías')
@section('contenido')
<main id="main" class="main">

  <div class="pagetitle flex justify-between items-center">
    <h1>Categorías Registradas</h1>
  </div>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
          <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center mt-3">
            <h5 class="mb-0">Categorías</h5>
            <a href="{{ route('categorias.create') }}" class="btn btn-light text-primary fw-bold">Agregar Nueva Categoría</a>
          </div>
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
                  <a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-sm btn-primary">Editar</a>
                  <form method="POST" action="{{ route('categorias.destroy', $categoria->id) }}">
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
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection