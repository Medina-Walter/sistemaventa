<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProveedorFactory extends Factory
{
    public function definition()
    {
        return [
            'nombre'      => $this->faker->company(),
            'email'       => $this->faker->unique()->safeEmail(),
            'telefono'    => $this->faker->phoneNumber(),
            'direccion'   => $this->faker->address(),
        ];
    }
}
