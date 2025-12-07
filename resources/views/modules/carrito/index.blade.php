@extends('layouts.main')
@section('titulo', 'Carrito de Compras')
@section('contenido')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">

                            <div
                                class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center border-0 rounded-top mt-3">
                                <h5 class="mb-0 fw-bold">Carrito de Compras</h5>
                            </div>

                            <div>
                                <table class="table table-hover table-bordered">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th>Código de Barra</th>
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>

                                    <tbody class="align-middle text-center">
                                        @forelse ($carrito as $item)
                                            <tr>
                                                <td>{{ $item['codigo'] ?? '—' }}</td>
                                                <td>{{ $item['nombre'] }}</td>
                                                <td>{{ $item['cantidad'] }}</td>
                                                <td>${{ number_format($item['precio_venta'], 2) }}</td>

                                                <td>
                                                    <form action="{{ route('carrito.update', $item['id']) }}" method="POST" class="d-inline">
    @csrf
    @method('PUT')
    <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" style="width:60px">
    <button type="submit" class="btn btn-sm btn-primary">
        <i class="bi bi-pencil-square"></i> Actualizar
    </button>
</form>


                                                    <form action="{{ route('carrito.destroy', $item['id']) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <i class="bi bi-trash"></i> Eliminar
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No hay productos en el carrito.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Botón Volver -->
                            <div class="d-flex gap-2 mt-3">

                                <a href="{{ url()->previous() }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left-circle"></i> Volver
                                </a>

                                <form action="{{ route('ventas.confirmar') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-cash-coin"></i> Realizar venta
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection
