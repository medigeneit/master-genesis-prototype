<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\BookingController
 */
final class BookingControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $bookings = Booking::factory()->count(3)->create();

        $response = $this->get(route('bookings.index'));

        $response->assertOk();
        $response->assertViewIs('booking.index');
        $response->assertViewHas('bookings');
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('bookings.create'));

        $response->assertOk();
        $response->assertViewIs('booking.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BookingController::class,
            'store',
            \App\Http\Requests\BookingStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $started_at = Carbon::parse($this->faker->dateTime());
        $department_id = $this->faker->numberBetween(-100000, 100000);
        $batch_id = $this->faker->numberBetween(-100000, 100000);

        $response = $this->post(route('bookings.store'), [
            'started_at' => $started_at->toDateTimeString(),
            'department_id' => $department_id,
            'batch_id' => $batch_id,
        ]);

        $bookings = Booking::query()
            ->where('started_at', $started_at)
            ->where('department_id', $department_id)
            ->where('batch_id', $batch_id)
            ->get();
        $this->assertCount(1, $bookings);
        $booking = $bookings->first();

        $response->assertRedirect(route('bookings.index'));
        $response->assertSessionHas('booking.id', $booking->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $booking = Booking::factory()->create();

        $response = $this->get(route('bookings.show', $booking));

        $response->assertOk();
        $response->assertViewIs('booking.show');
        $response->assertViewHas('booking');
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $booking = Booking::factory()->create();

        $response = $this->get(route('bookings.edit', $booking));

        $response->assertOk();
        $response->assertViewIs('booking.edit');
        $response->assertViewHas('booking');
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\BookingController::class,
            'update',
            \App\Http\Requests\BookingUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $booking = Booking::factory()->create();
        $started_at = Carbon::parse($this->faker->dateTime());
        $department_id = $this->faker->numberBetween(-100000, 100000);
        $batch_id = $this->faker->numberBetween(-100000, 100000);

        $response = $this->put(route('bookings.update', $booking), [
            'started_at' => $started_at->toDateTimeString(),
            'department_id' => $department_id,
            'batch_id' => $batch_id,
        ]);

        $booking->refresh();

        $response->assertRedirect(route('bookings.index'));
        $response->assertSessionHas('booking.id', $booking->id);

        $this->assertEquals($started_at->timestamp, $booking->started_at);
        $this->assertEquals($department_id, $booking->department_id);
        $this->assertEquals($batch_id, $booking->batch_id);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $booking = Booking::factory()->create();

        $response = $this->delete(route('bookings.destroy', $booking));

        $response->assertRedirect(route('bookings.index'));

        $this->assertModelMissing($booking);
    }
}
