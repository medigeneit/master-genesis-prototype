<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'started_at',
        'ending_at',
        'topic_id',
        'department_id',
        'bookable_type',
        'bookable_id',
        'batch_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'started_at' => 'timestamp',
        'ending_at' => 'timestamp',
        'topic_id' => 'integer',
        'department_id' => 'integer',
        'bookable_id' => 'integer',
        'batch_id' => 'integer',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(Batch::class);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function rooms(): BelongsToMany
    {
        return $this->belongsToMany(Room::class)
            ->using(RoomBooking::class)
            ->as('room_booking')
            ->withPivot('room_id', 'booking_id')
            ->withTimestamps();
    }

    public function mentors(): BelongsToMany
    {
        return $this->belongsToMany(Mentor::class)
            ->using(MentorBooking::class)
            ->as('mentor_booking')
            ->withPivot('mentor_id', 'booking_id')
            ->withTimestamps();
    }
}
