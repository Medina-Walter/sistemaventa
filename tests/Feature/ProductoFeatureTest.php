<?php

namespace Tests\Feature;

use App\Models\Categoria;
use App\Models\Proveedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_crear_un_producto_via_http()
    {
        $categoria = Categoria::factory()->create();
        $proveedor = Proveedor::factory()->create();

        $payload = [
            'nombre'        => 'Monitor 27 pulgadas',
            'codigo'        => 'MON-001',
            'descripcion'   => 'Monitor IPS 144hz',
            'stock'         => 5,
            'precio_compra' => 120000,
            'precio_venta'  => 160000,
            'id_categoria'  => $categoria->id,
            'id_proveedor'  => $proveedor->id,
            'id_imagen'     => null,
        ];

        $response = $this->post('/productos', $payload);

        $response->assertStatus(302);

        $this->assertDatabaseHas('productos', [
            'nombre' => 'Monitor 27 pulgadas',
        ]);
    }
}
