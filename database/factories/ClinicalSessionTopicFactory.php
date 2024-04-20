<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ClinicalSessionTopic;
use App\Models\FacultyDiscipline;
use App\Models\Session;
use App\Models\Topic;

class ClinicalSessionTopicFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClinicalSessionTopic::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'clinical_id' => FacultyDiscipline::factory(),
            'topic_id' => Topic::factory(),
            'session_id' => Session::factory(),
        ];
    }
}
