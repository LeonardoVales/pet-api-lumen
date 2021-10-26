<?php

namespace Database\Factories;

use App\Models\ServicoModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class ServicoModelFactory extends Factory
{
        /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ServicoModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => Uuid::uuid4(),
            'nome' => $this->faker->title,
            'created_at' => Carbon::now()->format(DATE_ISO8601),
            'updated_at' => Carbon::tomorrow()->format(DATE_ISO8601)
        ];
    }
}