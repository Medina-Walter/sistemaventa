<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ticket de Venta #{{ $venta->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .ticket {
            width: 300px;
            margin: auto;
            padding: 10px;
            border: 1px solid #000;
        }

        h2,
        h3 {
            text-align: center;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            text-align: left;
            padding: 3px 0;
        }

        th {
            border-bottom: 1px solid #000;
        }

        tfoot td {
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <h2>Sistema de Ventas y Almacén</h2>
        <h3>Ticket de Venta</h3>

        <p>ID Venta: {{ $venta->id }}</p>
        <p>Usuario: {{ $venta->usuario->usuario ?? '—' }}</p>
        <p>Fecha: {{ $venta->created_at->format('d/m/Y H:i') }}</p>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th class="center">Cantidad</th>
                    <th class="right">Precio</th>
                    <th class="right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venta->detalles as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->nombre ?? 'ID: ' . $detalle->id_producto }}</td>
                        <td class="center">{{ $detalle->cantidad }}</td>
                        <td class="right">${{ number_format($detalle->precio_unitario, 2) }}</td>
                        <td class="right">${{ number_format($detalle->sub_total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="right">Total:</td>
                    <td class="right">${{ number_format($venta->total_venta, 2) }}</td>
                </tr>
            </tfoot>
        </table>

        <p class="center">¡Gracias por su compra!</p>
    </div>
</body>

</html>
