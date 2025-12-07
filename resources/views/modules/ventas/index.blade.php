@extends('layouts.main')
@section('titulo', 'Dashboard')
@section('contenido')
    <main id="main" class="main">

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div
                                class="card-header bg-gradient bg-primary text-white d-flex justify-content-between align-items-center rounded-top mt-3">
                                <h5 class="mb-0 fw-bold"><i class="bi bi-people-fill me-2"></i>Ventas registradas</h5>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover align-middle">
                                    <thead class="bg-primary">
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Total Vendido</th>
                                            <th class="text-center">Fecha de Venta</th>
                                            <th class="text-center">Usuario</th>
                                            <th class="text-center">Imprimir Ticket</th>
                                            <th class="text-center">Acciones</th>
                                            <th class="text-center">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @foreach ($ventas as $venta)
                                            <tr>
                                                <td class="text-center">{{ $venta->id }}</td>
                                                <td class="text-center">${{ number_format($venta->total_venta, 2) }}</td>
                                                <td class="text-center">{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                                                <td class="text-center">{{ $venta->usuario->usuario ?? '—' }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('ventas.ticket', $venta->id) }}"
                                                        class="btn btn-sm btn-primary text-center">
                                                        🧾 Ticket
                                                    </a>
                                                </td>
                                                <td class="d-flex justify-content-center gap-2">
                                                    <div class="d-flex">
                                                        <div class="text-center">
                                                            <a href="{{ route('ventas.show', $venta->id) }}"
                                                            class="btn btn-sm btn-primary me-2">Ver Detalle</a>
                                                        </div>
                                                        @if ($venta->estado === 'activa')
                                                            <form action="{{ route('ventas.anular', $venta->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-warning text-center">Anular</button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('ventas.activar', $venta->id) }}"
                                                                method="POST" class="d-inline">
                                                                @csrf
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-success text-center">Activar</button>
                                                            </form>
                                                        @endif

                                                <td>
                                                    @if ($venta->estado === 'activa')
                                                        <span class="badge bg-success text-center">Activa</span>
                                                    @else
                                                        <span class="badge bg-danger text-center">Anulada</span>
                                                    @endif
                                                </td>
                            </div>
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
