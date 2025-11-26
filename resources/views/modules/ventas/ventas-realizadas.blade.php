@extends('layouts.main')

@section('content')
<div class="container">
    <h2 class="mb-4">Productos Vendidos</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Total Vendido</th>
                    <th>Fecha de Venta</th>
                    <th>Usuario</th>
                    <th>Imprimir Ticket</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $venta)
                    <tr>
                        <td>${{ number_format($venta->total_venta, 2) }}</td>
                        <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $venta->usuario->name ?? '—' }}</td>
                        <td>
                            <a href="{{ route('ventas.ticket', $venta->id_venta) }}" class="btn btn-sm btn-primary">
                                🧾 Ticket
                            </a>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <a href="{{ route('ventas.show', $venta->id_venta) }}" class="btn btn-sm btn-primary">Ver</a>
                                <a href="{{ route('ventas.edit', $venta->id_venta) }}" class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('ventas.destroy', $venta->id_venta) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $ventas->links() }}
</div>
@endsection
