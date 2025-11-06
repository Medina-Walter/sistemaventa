@extends('layouts.main')

@section('titulo', 'Listado de Productos')

@section('contenido')
<main id="main" class="main">
  <div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Productos</h2>
    </div>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow">
      <div class="card-body">

        {{-- Buscador --}}
        <form method="GET" action="{{ route('productos.index') }}" class="mb-4">
          <div class="input-group">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar..." value="{{ $query ?? '' }}">
            <button class="btn btn-outline-primary" type="submit">Buscar</button>
          </div>
        </form>

        <table class="table table-bordered table-hover">
          <thead class="d-none"></thead>
          <tbody>
           @forelse ($productos as $producto)
  <tr>
    <td colspan="8">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center p-3">
        {{-- Datos del producto --}}
        <div class="flex-grow-1">
          <p class="mb-1"><strong>Nombre:</strong> {{ $producto->nombre }}</p>
          <p class="mb-1"><strong>Código de barra:</strong> {{ $producto->codigo }}</p>
          <p class="mb-1"><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
          <p class="mb-1"><strong>Categoría:</strong> {{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
          <p class="mb-1"><strong>Cantidad:</strong> {{ $producto->stock }}</p>
          <p class="mb-1"><strong>Precio de compra:</strong> ${{ number_format($producto->precio_compra, 2) }}</p>
          <p class="mb-1"><strong>Precio de venta:</strong> ${{ number_format($producto->precio_venta, 2) }}</p>
          <div class="mt-2 d-flex gap-2">
            <a href="{{ route('productos.edit', $producto->id_producto) }}" class="btn btn-sm btn-primary">Editar</a>
            <form method="POST" action="{{ route('productos.destroy', $producto->id_producto) }}">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
            </form>
          </div>
        </div>

        {{-- Imagen del producto --}}
        <div class="ms-md-4 mt-3 mt-md-0 text-center">
          @if ($producto->imagen)
            <img src="{{ asset('storage/' . $producto->imagen->ruta) }}"
                 alt="Imagen"
                 style="width: 260px; height: auto; object-fit: cover; border-radius: 16px;">
          @else
            <span class="text-muted">Sin imagen</span>
          @endif
        </div>
      </div>
    </td>
  </tr>
@empty
  <tr>
    <td colspan="8" class="text-center">No hay productos registrados.</td>
  </tr>
@endforelse


          </tbody>
        </table>

        {{-- Paginación --}}
        <div class="d-flex justify-content-center mt-4">
          {{ $productos->links('vendor.pagination.bootstrap-5') }}
        </div>
      </div>
    </div>
  </div>
</main>
@endsection
