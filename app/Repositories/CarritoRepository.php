<?php

namespace App\Repositories;

class CarritoRepository
{
    const SESSION_KEY = 'carrito';

    public function obtenerCarrito()
    {
        return session(self::SESSION_KEY, []);
    }

    public function agregarProducto($producto, $cantidad)
    {
        $carrito = $this->obtenerCarrito();

        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad'] += $cantidad;
        } else {
            $carrito[$producto->id] = [
                'id' => $producto->id,
                'nombre' => $producto->nombre,
                'precio_venta' => $producto->precio_venta,
                'cantidad' => $cantidad,
                'subtotal' => $producto->precio_venta * $cantidad
            ];
        }

        session([self::SESSION_KEY => $carrito]);
    }

    public function actualizarCantidad($productoId, $cantidad)
    {
        $carrito = $this->obtenerCarrito();

        if (isset($carrito[$productoId])) {
            $carrito[$productoId]['cantidad'] = $cantidad;
            $carrito[$productoId]['subtotal'] = $cantidad * $carrito[$productoId]['precio_venta'];
        }

        session([self::SESSION_KEY => $carrito]);
    }

    public function eliminarProducto($productoId)
    {
        $carrito = $this->obtenerCarrito();

        unset($carrito[$productoId]);

        session([self::SESSION_KEY => $carrito]);
    }

    public function vaciarCarrito()
    {
        session()->forget(self::SESSION_KEY);
    }

    public function total()
    {
        $carrito = $this->obtenerCarrito();

        return array_sum(array_column($carrito, 'subtotal'));
    }
}
