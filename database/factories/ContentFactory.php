<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Content;
use App\Models\Session;
use App\Models\Topic;

class ContentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Content::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'topic_id' => Topic::factory(),
            'type' => $this->faker->numberBetween(-8, 8),
            'material_id' => $this->faker->randomNumber(),
            'batch_id' => $this->faker->randomNumber(),
            'session_id' => Session::factory(),
            'clinical_id' => $this->faker->randomNumber(),
        ];
    }
}
