<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Batch;
use App\Models\Booking;
use App\Models\Department;
use App\Models\Topic;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'started_at' => $this->faker->dateTime(),
            'ending_at' => $this->faker->dateTime(),
            'topic_id' => Topic::factory(),
            'department_id' => Department::factory(),
            'bookable_type' => $this->faker->word(),
            'bookable_id' => $this->faker->randomNumber(),
            'batch_id' => Batch::factory(),
        ];
    }
}
