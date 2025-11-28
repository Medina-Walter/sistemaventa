@extends('layouts.main')
@section('titulo', 'Detalle de Venta')
@section('contenido')

    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Detalle de Venta</h5>

                            <div class="mb-3">
                                <strong>Venta ID:</strong> {{ $venta->id }} <br>
                                <strong>Usuario:</strong> {{ $venta->usuario->usuario ?? '—' }} <br>
                                <strong>Fecha:</strong> {{ $venta->created_at }} <br>
                                <strong>Total Venta:</strong> ${{ number_format($venta->total_venta, 2) }}
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-light text-center">
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody class="align-middle text-center">
                                        @forelse ($venta->detalles as $detalle)
                                            <tr>
                                                <td>{{ $detalle->producto->nombre ?? 'ID: ' . $detalle->id_producto }}</td>
                                                <td>{{ $detalle->cantidad }}</td>
                                                <td>${{ number_format($detalle->precio_unitario, 2) }}</td>
                                                <td>${{ number_format($detalle->sub_total, 2) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No hay detalles de venta registrados.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            <!-- Botón Volver -->
                            <div class="mt-3">
                                <a href="{{ route('ventas.index') }}" class="btn btn-secondary">
                                    <i class="bi bi-arrow-left-circle"></i> Volver
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
