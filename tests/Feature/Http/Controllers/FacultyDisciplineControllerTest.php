<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\ClinicalSessionTopic;
use App\Models\FacultyDiscipline;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\FacultyDisciplineController
 */
final class FacultyDisciplineControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $facultyDisciplines = FacultyDiscipline::factory()->count(3)->create();

        $response = $this->get(route('faculty-disciplines.index'));

        $response->assertOk();
        $response->assertViewIs('facultyDiscipline.index');
        $response->assertViewHas('facultyDisciplines');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('faculty-disciplines.create'));

        $response->assertOk();
        $response->assertViewIs('facultyDiscipline.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FacultyDisciplineController::class,
            'store',
            \App\Http\Requests\FacultyDisciplineStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $clinical_session_topic = ClinicalSessionTopic::factory()->create();

        $response = $this->post(route('faculty-disciplines.store'), [
            'name' => $name,
            'clinical_session_topic_id' => $clinical_session_topic->id,
        ]);

        $facultyDisciplines = FacultyDiscipline::query()
            ->where('name', $name)
            ->where('clinical_session_topic_id', $clinical_session_topic->id)
            ->get();
        $this->assertCount(1, $facultyDisciplines);
        $facultyDiscipline = $facultyDisciplines->first();

        $response->assertRedirect(route('facultyDisciplines.index'));
        $response->assertSessionHas('facultyDiscipline.id', $facultyDiscipline->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $facultyDiscipline = FacultyDiscipline::factory()->create();

        $response = $this->get(route('faculty-disciplines.show', $facultyDiscipline));

        $response->assertOk();
        $response->assertViewIs('facultyDiscipline.show');
        $response->assertViewHas('facultyDiscipline');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $facultyDiscipline = FacultyDiscipline::factory()->create();

        $response = $this->get(route('faculty-disciplines.edit', $facultyDiscipline));

        $response->assertOk();
        $response->assertViewIs('facultyDiscipline.edit');
        $response->assertViewHas('facultyDiscipline');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\FacultyDisciplineController::class,
            'update',
            \App\Http\Requests\FacultyDisciplineUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $facultyDiscipline = FacultyDiscipline::factory()->create();
        $name = $this->faker->name();
        $clinical_session_topic = ClinicalSessionTopic::factory()->create();

        $response = $this->put(route('faculty-disciplines.update', $facultyDiscipline), [
            'name' => $name,
            'clinical_session_topic_id' => $clinical_session_topic->id,
        ]);

        $facultyDiscipline->refresh();

        $response->assertRedirect(route('facultyDisciplines.index'));
        $response->assertSessionHas('facultyDiscipline.id', $facultyDiscipline->id);

        $this->assertEquals($name, $facultyDiscipline->name);
        $this->assertEquals($clinical_session_topic->id, $facultyDiscipline->clinical_session_topic_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $facultyDiscipline = FacultyDiscipline::factory()->create();

        $response = $this->delete(route('faculty-disciplines.destroy', $facultyDiscipline));

        $response->assertRedirect(route('facultyDisciplines.index'));

        $this->assertModelMissing($facultyDiscipline);
    }
}
