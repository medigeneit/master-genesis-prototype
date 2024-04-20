<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Content;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ContentController
 */
final class ContentControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $contents = Content::factory()->count(3)->create();

        $response = $this->get(route('contents.index'));

        $response->assertOk();
        $response->assertViewIs('content.index');
        $response->assertViewHas('contents');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('contents.create'));

        $response->assertOk();
        $response->assertViewIs('content.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ContentController::class,
            'store',
            \App\Http\Requests\ContentStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $topic_id = $this->faker->numberBetween(-100000, 100000);
        $type = $this->faker->numberBetween(-8, 8);
        $material_id = $this->faker->numberBetween(-100000, 100000);
        $session_id = $this->faker->numberBetween(-100000, 100000);

        $response = $this->post(route('contents.store'), [
            'topic_id' => $topic_id,
            'type' => $type,
            'material_id' => $material_id,
            'session_id' => $session_id,
        ]);

        $contents = Content::query()
            ->where('topic_id', $topic_id)
            ->where('type', $type)
            ->where('material_id', $material_id)
            ->where('session_id', $session_id)
            ->get();
        $this->assertCount(1, $contents);
        $content = $contents->first();

        $response->assertRedirect(route('contents.index'));
        $response->assertSessionHas('content.id', $content->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $content = Content::factory()->create();

        $response = $this->get(route('contents.show', $content));

        $response->assertOk();
        $response->assertViewIs('content.show');
        $response->assertViewHas('content');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $content = Content::factory()->create();

        $response = $this->get(route('contents.edit', $content));

        $response->assertOk();
        $response->assertViewIs('content.edit');
        $response->assertViewHas('content');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ContentController::class,
            'update',
            \App\Http\Requests\ContentUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $content = Content::factory()->create();
        $topic_id = $this->faker->numberBetween(-100000, 100000);
        $type = $this->faker->numberBetween(-8, 8);
        $material_id = $this->faker->numberBetween(-100000, 100000);
        $session_id = $this->faker->numberBetween(-100000, 100000);

        $response = $this->put(route('contents.update', $content), [
            'topic_id' => $topic_id,
            'type' => $type,
            'material_id' => $material_id,
            'session_id' => $session_id,
        ]);

        $content->refresh();

        $response->assertRedirect(route('contents.index'));
        $response->assertSessionHas('content.id', $content->id);

        $this->assertEquals($topic_id, $content->topic_id);
        $this->assertEquals($type, $content->type);
        $this->assertEquals($material_id, $content->material_id);
        $this->assertEquals($session_id, $content->session_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $content = Content::factory()->create();

        $response = $this->delete(route('contents.destroy', $content));

        $response->assertRedirect(route('contents.index'));

        $this->assertModelMissing($content);
    }
}
