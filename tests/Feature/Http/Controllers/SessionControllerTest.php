<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SessionController
 */
final class SessionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $sessions = Session::factory()->count(3)->create();

        $response = $this->get(route('sessions.index'));

        $response->assertOk();
        $response->assertViewIs('session.index');
        $response->assertViewHas('sessions');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('sessions.create'));

        $response->assertOk();
        $response->assertViewIs('session.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SessionController::class,
            'store',
            \App\Http\Requests\SessionStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $course_id = $this->faker->numberBetween(-100000, 100000);
        $year = $this->faker->numberBetween(-1000, 1000);
        $name = $this->faker->name();
        $starting = Carbon::parse($this->faker->dateTime());
        $ending = Carbon::parse($this->faker->dateTime());

        $response = $this->post(route('sessions.store'), [
            'course_id' => $course_id,
            'year' => $year,
            'name' => $name,
            'starting' => $starting->toDateTimeString(),
            'ending' => $ending->toDateTimeString(),
        ]);

        $sessions = Session::query()
            ->where('course_id', $course_id)
            ->where('year', $year)
            ->where('name', $name)
            ->where('starting', $starting)
            ->where('ending', $ending)
            ->get();
        $this->assertCount(1, $sessions);
        $session = $sessions->first();

        $response->assertRedirect(route('sessions.index'));
        $response->assertSessionHas('session.id', $session->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $session = Session::factory()->create();

        $response = $this->get(route('sessions.show', $session));

        $response->assertOk();
        $response->assertViewIs('session.show');
        $response->assertViewHas('session');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $session = Session::factory()->create();

        $response = $this->get(route('sessions.edit', $session));

        $response->assertOk();
        $response->assertViewIs('session.edit');
        $response->assertViewHas('session');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SessionController::class,
            'update',
            \App\Http\Requests\SessionUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $session = Session::factory()->create();
        $course_id = $this->faker->numberBetween(-100000, 100000);
        $year = $this->faker->numberBetween(-1000, 1000);
        $name = $this->faker->name();
        $starting = Carbon::parse($this->faker->dateTime());
        $ending = Carbon::parse($this->faker->dateTime());

        $response = $this->put(route('sessions.update', $session), [
            'course_id' => $course_id,
            'year' => $year,
            'name' => $name,
            'starting' => $starting->toDateTimeString(),
            'ending' => $ending->toDateTimeString(),
        ]);

        $session->refresh();

        $response->assertRedirect(route('sessions.index'));
        $response->assertSessionHas('session.id', $session->id);

        $this->assertEquals($course_id, $session->course_id);
        $this->assertEquals($year, $session->year);
        $this->assertEquals($name, $session->name);
        $this->assertEquals($starting, $session->starting);
        $this->assertEquals($ending, $session->ending);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $session = Session::factory()->create();

        $response = $this->delete(route('sessions.destroy', $session));

        $response->assertRedirect(route('sessions.index'));

        $this->assertModelMissing($session);
    }
}
