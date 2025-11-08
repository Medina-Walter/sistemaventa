@extends('layouts.main')
@section('titulo', 'Dashboard')
@section('contenido')
    <main id="main" class="main">

        <div class="pagetitle flex justify-between items-center">
            <h1>Productos</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center mt-3">
                                <h5 class="mb-0">Productos registrados</h5>
                                <a href="{{ route('productos.create') }}" class="btn btn-light text-primary fw-bold">Agregar Nuevo Producto</a>
                            </div>
                            <form method="GET" action="{{ route('productos.index') }}" class="mb-4 mt-3">
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
                                                <div
                                                    class="d-flex flex-column flex-md-row justify-content-between align-items-center p-3">
                                                    {{-- Datos del producto --}}
                                                    <div class="flex-grow-1">
                                                        <p class="mb-1"><strong>Nombre:</strong> {{ $producto->nombre }}
                                                        </p>
                                                        <p class="mb-1"><strong>Código de barra:</strong>
                                                            {{ $producto->codigo }}
                                                        </p>
                                                        <p class="mb-1"><strong>Descripción:</strong>
                                                            {{ $producto->descripcion }}
                                                        </p>
                                                        <p class="mb-1"><strong>Categoría:</strong>
                                                            {{ $producto->categoria->nombre ?? 'Sin categoría' }}</p>
                                                        <p class="mb-1"><strong>Cantidad:</strong> {{ $producto->stock }}
                                                        </p>
                                                        <p class="mb-1"><strong>Precio de compra:</strong>
                                                            ${{ number_format($producto->precio_compra, 2) }}</p>
                                                        <p class="mb-1"><strong>Precio de venta:</strong>
                                                            ${{ number_format($producto->precio_venta, 2) }}</p>
                                                        <div class="mt-2 d-flex gap-2">
                                                            <a href="{{ route('productos.edit', $producto->id) }}"
                                                                class="btn btn-sm btn-primary">Editar</a>
                                                            <form method="POST"
                                                                action="{{ route('productos.destroy', $producto->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                    onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
                                                            </form>
                                                        </div>
                                                    </div>

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

                            <div class="d-flex justify-content-center mt-4">
                                {{ $productos->links('vendor.pagination.bootstrap-5') }}
                            </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
