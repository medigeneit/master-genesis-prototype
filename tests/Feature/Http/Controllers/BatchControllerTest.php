<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Batch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BatchController
 */
final class BatchControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $batches = Batch::factory()->count(3)->create();

        $response = $this->get(route('batches.index'));

        $response->assertOk();
        $response->assertViewIs('batch.index');
        $response->assertViewHas('batches');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('batches.create'));

        $response->assertOk();
        $response->assertViewIs('batch.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BatchController::class,
            'store',
            \App\Http\Requests\BatchStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $session_id = $this->faker->numberBetween(-100000, 100000);
        $module_id = $this->faker->numberBetween(-100000, 100000);

        $response = $this->post(route('batches.store'), [
            'name' => $name,
            'session_id' => $session_id,
            'module_id' => $module_id,
        ]);

        $batches = Batch::query()
            ->where('name', $name)
            ->where('session_id', $session_id)
            ->where('module_id', $module_id)
            ->get();
        $this->assertCount(1, $batches);
        $batch = $batches->first();

        $response->assertRedirect(route('batches.index'));
        $response->assertSessionHas('batch.id', $batch->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $batch = Batch::factory()->create();

        $response = $this->get(route('batches.show', $batch));

        $response->assertOk();
        $response->assertViewIs('batch.show');
        $response->assertViewHas('batch');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $batch = Batch::factory()->create();

        $response = $this->get(route('batches.edit', $batch));

        $response->assertOk();
        $response->assertViewIs('batch.edit');
        $response->assertViewHas('batch');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BatchController::class,
            'update',
            \App\Http\Requests\BatchUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $batch = Batch::factory()->create();
        $name = $this->faker->name();
        $session_id = $this->faker->numberBetween(-100000, 100000);
        $module_id = $this->faker->numberBetween(-100000, 100000);

        $response = $this->put(route('batches.update', $batch), [
            'name' => $name,
            'session_id' => $session_id,
            'module_id' => $module_id,
        ]);

        $batch->refresh();

        $response->assertRedirect(route('batches.index'));
        $response->assertSessionHas('batch.id', $batch->id);

        $this->assertEquals($name, $batch->name);
        $this->assertEquals($session_id, $batch->session_id);
        $this->assertEquals($module_id, $batch->module_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $batch = Batch::factory()->create();

        $response = $this->delete(route('batches.destroy', $batch));

        $response->assertRedirect(route('batches.index'));

        $this->assertModelMissing($batch);
    }
}
