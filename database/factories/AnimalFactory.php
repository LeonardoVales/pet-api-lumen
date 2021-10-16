<?php

namespace Database\Factories;

use App\Models\Animal;
use App\Models\Dono;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Uuid;

class AnimalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Animal::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [            
            'nome' => $this->faker->name,
            'idade' => 25,
            'especie' => 'Cachorro',
            'raca' => 'Vira lata',
            'id_dono' => '5cbc2a5c-0221-481b-930b-2a091e50f6e8',
            'created_at' => Carbon::now()->format(DATE_ISO8601),
            'updated_at' => Carbon::tomorrow()->format(DATE_ISO8601)
        ];
    }
}