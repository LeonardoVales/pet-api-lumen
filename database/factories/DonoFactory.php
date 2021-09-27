<?php

namespace Database\Factories;

use App\Models\Dono;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonoFactory extends Factory
{
        /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dono::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'telefone' => $this->faker->phoneNumber()
        ];
    }
}