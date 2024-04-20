<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MentorController
 */
final class MentorControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $mentors = Mentor::factory()->count(3)->create();

        $response = $this->get(route('mentors.index'));

        $response->assertOk();
        $response->assertViewIs('mentor.index');
        $response->assertViewHas('mentors');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('mentors.create'));

        $response->assertOk();
        $response->assertViewIs('mentor.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MentorController::class,
            'store',
            \App\Http\Requests\MentorStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();

        $response = $this->post(route('mentors.store'), [
            'name' => $name,
        ]);

        $mentors = Mentor::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $mentors);
        $mentor = $mentors->first();

        $response->assertRedirect(route('mentors.index'));
        $response->assertSessionHas('mentor.id', $mentor->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $mentor = Mentor::factory()->create();

        $response = $this->get(route('mentors.show', $mentor));

        $response->assertOk();
        $response->assertViewIs('mentor.show');
        $response->assertViewHas('mentor');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $mentor = Mentor::factory()->create();

        $response = $this->get(route('mentors.edit', $mentor));

        $response->assertOk();
        $response->assertViewIs('mentor.edit');
        $response->assertViewHas('mentor');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MentorController::class,
            'update',
            \App\Http\Requests\MentorUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $mentor = Mentor::factory()->create();
        $name = $this->faker->name();

        $response = $this->put(route('mentors.update', $mentor), [
            'name' => $name,
        ]);

        $mentor->refresh();

        $response->assertRedirect(route('mentors.index'));
        $response->assertSessionHas('mentor.id', $mentor->id);

        $this->assertEquals($name, $mentor->name);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $mentor = Mentor::factory()->create();

        $response = $this->delete(route('mentors.destroy', $mentor));

        $response->assertRedirect(route('mentors.index'));

        $this->assertModelMissing($mentor);
    }
}
