<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Room;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\RoomController
 */
final class RoomControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $rooms = Room::factory()->count(3)->create();

        $response = $this->get(route('rooms.index'));

        $response->assertOk();
        $response->assertViewIs('room.index');
        $response->assertViewHas('rooms');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('rooms.create'));

        $response->assertOk();
        $response->assertViewIs('room.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RoomController::class,
            'store',
            \App\Http\Requests\RoomStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = $this->faker->name();
        $branch_id = $this->faker->numberBetween(-100000, 100000);

        $response = $this->post(route('rooms.store'), [
            'name' => $name,
            'branch_id' => $branch_id,
        ]);

        $rooms = Room::query()
            ->where('name', $name)
            ->where('branch_id', $branch_id)
            ->get();
        $this->assertCount(1, $rooms);
        $room = $rooms->first();

        $response->assertRedirect(route('rooms.index'));
        $response->assertSessionHas('room.id', $room->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $room = Room::factory()->create();

        $response = $this->get(route('rooms.show', $room));

        $response->assertOk();
        $response->assertViewIs('room.show');
        $response->assertViewHas('room');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $room = Room::factory()->create();

        $response = $this->get(route('rooms.edit', $room));

        $response->assertOk();
        $response->assertViewIs('room.edit');
        $response->assertViewHas('room');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\RoomController::class,
            'update',
            \App\Http\Requests\RoomUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $room = Room::factory()->create();
        $name = $this->faker->name();
        $branch_id = $this->faker->numberBetween(-100000, 100000);

        $response = $this->put(route('rooms.update', $room), [
            'name' => $name,
            'branch_id' => $branch_id,
        ]);

        $room->refresh();

        $response->assertRedirect(route('rooms.index'));
        $response->assertSessionHas('room.id', $room->id);

        $this->assertEquals($name, $room->name);
        $this->assertEquals($branch_id, $room->branch_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $room = Room::factory()->create();

        $response = $this->delete(route('rooms.destroy', $room));

        $response->assertRedirect(route('rooms.index'));

        $this->assertModelMissing($room);
    }
}
