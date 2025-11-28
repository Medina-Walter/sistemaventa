<h1> Reporte de Ventas</h1>
<table border="1" width="100%" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>ID Venta</th>
            <th>Fecha</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ventas as $venta)
            <tr>
                <td>{{ $venta->id}}</td>
                <td>{{ $venta->created_at }}</td>
                <td>${{ number_format($venta->total_venta, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
