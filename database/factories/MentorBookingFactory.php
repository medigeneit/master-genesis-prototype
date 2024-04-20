<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Booking;
use App\Models\Mentor;
use App\Models\MentorBooking;

class MentorBookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MentorBooking::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'mentor_id' => Mentor::factory(),
            'booking_id' => Booking::factory(),
        ];
    }
}
