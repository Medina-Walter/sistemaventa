<h1>Reporte de Ventas</h1>

<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr>
            <th>ID Venta</th>
            <th>Total</th>
            <th>Fecha</th>
            <th>Horario</th>
            <th>Usuario</th>
            <th>Estado</th>
            <th>Cantidad</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($ventas as $venta)
            <tr>
                <td>{{ $venta->id }}</td>
                <td>${{ number_format($venta->total_venta, 2) }}</td>
                <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                <td>{{ $venta->created_at->format('H:i:s') }}</td>
                <td>{{ $venta->usuario->usuario ?? '—' }}</td>
                <td>{{ ucfirst($venta->estado) }}</td>
                <td>{{ $venta->detalleVenta->sum('cantidad') }}</td>

            </tr>
        @endforeach
    </tbody>
</table>
