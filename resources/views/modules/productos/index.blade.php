@extends('layouts.main')
@section('titulo', 'Dashboard')
@section('contenido')
    <main id="main" class="main">

        <!-- Título de página -->
        <div class="pagetitle d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-primary">📦 Productos</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-lg border-0 rounded-3">
                        <div class="card-body">

                            <!-- Header de la card -->
                            <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center rounded-top mt-3">
                                <h5 class="mb-0 fw-bold">Productos registrados</h5>
                                <a href="{{ route('productos.create') }}"
                                    class="btn btn-light text-primary fw-bold shadow-sm">
                                    <i class="bi bi-plus-circle me-1"></i> Agregar Nuevo Producto
                                </a>
                            </div>

                            <!-- Buscador -->
                            <form method="GET" action="{{ route('productos.index') }}" class="mb-4 mt-3">
                                <div class="input-group shadow-sm">
                                    <input type="text" name="buscar" class="form-control border-primary"
                                        placeholder="🔍 Buscar producto..." value="{{ $query ?? '' }}">
                                    <button class="btn btn-primary fw-bold" type="submit">Buscar</button>
                                </div>
                            </form>

                            <!-- Grid de productos -->
                            <div class="row">
                                @forelse ($productos as $producto)
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100 shadow-sm border-0 rounded-3 hover-card">

                                            <!-- Imagen -->
                                            <div class="text-center p-3 bg-light rounded-top">
                                                @if ($producto->imagen)
                                                    <img src="{{ asset('storage/' . $producto->imagen->ruta) }}"
                                                        alt="Imagen" class="img-fluid rounded shadow-sm"
                                                        style="max-height: 200px; object-fit: cover;">
                                                @else
                                                    <span class="text-muted">Sin imagen</span>
                                                @endif
                                            </div>

                                            <!-- Datos -->
                                            <div class="card-body">
                                                <p class="mb-1"><strong>Nombre:</strong> {{ $producto->nombre }}</p>
                                                <p class="mb-1"><strong>Código de barra:</strong> {{ $producto->codigo }}
                                                </p>
                                                <p class="mb-1"><strong>Descripción:</strong> {{ $producto->descripcion }}
                                                </p>
                                                <p class="mb-1"><strong>Categoría:</strong>
                                                    {{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
                                                <p class="mb-1"><strong>Cantidad:</strong> {{ $producto->stock }}</p>
                                                <p class="mb-1"><strong>Precio compra:</strong>
                                                    ${{ number_format($producto->precio_compra, 2) }}</p>
                                                <p class="mb-1"><strong>Precio venta:</strong>
                                                    ${{ number_format($producto->precio_venta, 2) }}</p>
                                            </div>

                                            <!-- Acciones -->
                                            <div class="card-footer d-flex flex-column gap-2 bg-light rounded-bottom">

                                                <!-- Añadir al carrito -->
                                                <form action="{{ route('carrito.store') }}" method="POST"
                                                    class="d-flex align-items-center">
                                                    @csrf
                                                    <input type="hidden" name="id_producto"
                                                        value="{{ $producto->id }}">
                                                    <input type="number" name="cantidad" value="1" min="1"
                                                        class="form-control me-2 border-primary shadow-sm"
                                                        style="width: 80px;">
                                                    <button type="submit" class="btn btn-success btn-sm fw-bold shadow-sm">
                                                        ➕ Añadir al Carrito
                                                    </button>
                                                </form>

                                                <!-- Editar / Eliminar -->
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('productos.edit', $producto->id) }}"
                                                        class="btn btn-primary btn-sm fw-bold shadow-sm">
                                                        ✏️ Editar
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('productos.destroy', $producto->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm fw-bold shadow-sm"
                                                            onclick="return confirm('¿Eliminar producto?')">
                                                            🗑️ Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center">
                                        <p class="text-muted">No hay productos registrados.</p>
                                    </div>
                                @endforelse
                            </div>

                            <!-- Paginación -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $productos->links('vendor.pagination.bootstrap-5') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- Estilos embebidos --}}
    <style>
        /* Hover en cards */
        .hover-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.15) !important;
        }
    </style>
@endsection
