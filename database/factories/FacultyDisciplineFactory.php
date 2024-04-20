<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ClinicalSessionTopic;
use App\Models\FacultyDiscipline;

class FacultyDisciplineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FacultyDiscipline::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'clinical_session_topic_id' => ClinicalSessionTopic::factory(),
        ];
    }
}
