<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Producto;

class ProductoTest extends TestCase
{
    /** @test */
    public function descuenta_stock_correctamente()
    {
        $producto = new Producto([
            'nombre' => 'Monitor gamer',
            'codigo' => 'MON0001',
            'descripcion' => 'Monitor LED 24 pulgadas',
            'stock' => 10,
            'precio_compra' => 85000,
            'precio_venta' => 110000,
        ]);

        $nuevoStock = $producto->descontarStock(3);

        $this->assertEquals(7, $nuevoStock);
        $this->assertEquals(7, $producto->stock);
    }
}
