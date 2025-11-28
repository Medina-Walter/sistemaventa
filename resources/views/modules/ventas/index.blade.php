@extends('layouts.main')
@section('titulo', 'Dashboard')
@section('contenido')
    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="mt-3">Productos Vendidos</h2>

                            <div
                                class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i>Ventas registradas</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th>Total Vendido</th>
                                            <th>Fecha de Venta</th>
                                            <th>Usuario</th>
                                            <th>Imprimir Ticket</th>
                                            <th>Acciones</th>
                                            <th>Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ventas as $venta)
                                            <tr>
                                                <td>${{ number_format($venta->total_venta, 2) }}</td>
                                                <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                                                <td>{{ $venta->usuario->usuario ?? '—' }}</td>
                                                <td>
                                                    <a href="{{ route('ventas.ticket', $venta->id) }}"
                                                        class="btn btn-sm btn-primary">
                                                        🧾 Ticket
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('ventas.show', $venta->id) }}"
                                                            class="btn btn-sm btn-primary me-2">Ver Detalle</a>
                                                        @if ($venta->estado === 'activa')
                                                            <form action="{{ route('ventas.anular', $venta->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-warning">Anular</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('ventas.activar', $venta->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-success">Activar</button>
                                                            </form>
                                                        @endif

                                                <td>
                                                    @if ($venta->estado === 'activa')
                                                        <span class="badge bg-success">Activa</span>
                                                    @else
                                                        <span class="badge bg-danger">Anulada</span>
                                                    @endif
                                                </td>
                            </div>
                            </td>
                            </tr>
                            @endforeach
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
@endsection
