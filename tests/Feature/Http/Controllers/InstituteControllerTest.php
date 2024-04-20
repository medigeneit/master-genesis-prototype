<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Institute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\InstituteController
 */
final class InstituteControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $institutes = Institute::factory()->count(3)->create();

        $response = $this->get(route('institutes.index'));

        $response->assertOk();
        $response->assertViewIs('institute.index');
        $response->assertViewHas('institutes');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('institutes.create'));

        $response->assertOk();
        $response->assertViewIs('institute.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InstituteController::class,
            'store',
            \App\Http\Requests\InstituteStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();

        $response = $this->post(route('institutes.store'), [
            'name' => $name,
        ]);

        $institutes = Institute::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $institutes);
        $institute = $institutes->first();

        $response->assertRedirect(route('institutes.index'));
        $response->assertSessionHas('institute.id', $institute->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $institute = Institute::factory()->create();

        $response = $this->get(route('institutes.show', $institute));

        $response->assertOk();
        $response->assertViewIs('institute.show');
        $response->assertViewHas('institute');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $institute = Institute::factory()->create();

        $response = $this->get(route('institutes.edit', $institute));

        $response->assertOk();
        $response->assertViewIs('institute.edit');
        $response->assertViewHas('institute');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\InstituteController::class,
            'update',
            \App\Http\Requests\InstituteUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $institute = Institute::factory()->create();
        $name = $this->faker->name();

        $response = $this->put(route('institutes.update', $institute), [
            'name' => $name,
        ]);

        $institute->refresh();

        $response->assertRedirect(route('institutes.index'));
        $response->assertSessionHas('institute.id', $institute->id);

        $this->assertEquals($name, $institute->name);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $institute = Institute::factory()->create();

        $response = $this->delete(route('institutes.destroy', $institute));

        $response->assertRedirect(route('institutes.index'));

        $this->assertModelMissing($institute);
    }
}
