<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Module;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ModuleController
 */
final class ModuleControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $modules = Module::factory()->count(3)->create();

        $response = $this->get(route('modules.index'));

        $response->assertOk();
        $response->assertViewIs('module.index');
        $response->assertViewHas('modules');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('modules.create'));

        $response->assertOk();
        $response->assertViewIs('module.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ModuleController::class,
            'store',
            \App\Http\Requests\ModuleStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $has_exam = $this->faker->boolean();
        $has_solve = $this->faker->boolean();
        $has_lecture = $this->faker->boolean();
        $has_feedback = $this->faker->boolean();

        $response = $this->post(route('modules.store'), [
            'name' => $name,
            'has_exam' => $has_exam,
            'has_solve' => $has_solve,
            'has_lecture' => $has_lecture,
            'has_feedback' => $has_feedback,
        ]);

        $modules = Module::query()
            ->where('name', $name)
            ->where('has_exam', $has_exam)
            ->where('has_solve', $has_solve)
            ->where('has_lecture', $has_lecture)
            ->where('has_feedback', $has_feedback)
            ->get();
        $this->assertCount(1, $modules);
        $module = $modules->first();

        $response->assertRedirect(route('modules.index'));
        $response->assertSessionHas('module.id', $module->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $module = Module::factory()->create();

        $response = $this->get(route('modules.show', $module));

        $response->assertOk();
        $response->assertViewIs('module.show');
        $response->assertViewHas('module');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $module = Module::factory()->create();

        $response = $this->get(route('modules.edit', $module));

        $response->assertOk();
        $response->assertViewIs('module.edit');
        $response->assertViewHas('module');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ModuleController::class,
            'update',
            \App\Http\Requests\ModuleUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $module = Module::factory()->create();
        $name = $this->faker->name();
        $has_exam = $this->faker->boolean();
        $has_solve = $this->faker->boolean();
        $has_lecture = $this->faker->boolean();
        $has_feedback = $this->faker->boolean();

        $response = $this->put(route('modules.update', $module), [
            'name' => $name,
            'has_exam' => $has_exam,
            'has_solve' => $has_solve,
            'has_lecture' => $has_lecture,
            'has_feedback' => $has_feedback,
        ]);

        $module->refresh();

        $response->assertRedirect(route('modules.index'));
        $response->assertSessionHas('module.id', $module->id);

        $this->assertEquals($name, $module->name);
        $this->assertEquals($has_exam, $module->has_exam);
        $this->assertEquals($has_solve, $module->has_solve);
        $this->assertEquals($has_lecture, $module->has_lecture);
        $this->assertEquals($has_feedback, $module->has_feedback);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $module = Module::factory()->create();

        $response = $this->delete(route('modules.destroy', $module));

        $response->assertRedirect(route('modules.index'));

        $this->assertModelMissing($module);
    }
}
