<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Session;

class SessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Session::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'year' => $this->faker->numberBetween(-1000, 1000),
            'name' => $this->faker->name(),
            'starting' => $this->faker->dateTime(),
            'ending' => $this->faker->dateTime(),
        ];
    }
}
