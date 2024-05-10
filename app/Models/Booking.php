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
        'duration',
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
        'started_at' => 'datetime',
        'duration' => 'integer',
        'topic_id' => 'integer',
        'department_id' => 'integer',
        'bookable_id' => 'integer',
        'batch_id' => 'integer',
    ];


    protected const bookable_types = [
        Batch::class => 'class',
        Program::class => 'program',
    ];

    public function getBookingTypeAttribute(){
        return self::bookable_types[$this->bookable_type] ?? '';
    }


    
    //Starting Date
    public function getStartingDateAttribute(){
        return $this->started_at ? $this->started_at->format('Y-m-d'):null;
    }

    //Starting Time
    public function getStartingTimeAttribute(){
        return $this->started_at ? $this->started_at->format('H:i'):null;
    }


    //Ending At
    public function getEndingAttribute(){
        return $this->started_at->addMinute($this->duration);
    }
    

    protected $_started_at_time, $_started_at_date;

    protected function set_starting_at(){
        if( $this->_started_at_time && $this->_started_at_date) {
            $this->started_at = "{$this->_started_at_time} {$this->_started_at_date}";
        }
    }
    
    //Starting Date
    public function setStartingDateAttribute($value){
        // dd($value );
        $this->_started_at_time = $value;
        $this->set_starting_at();
    }
    
    //Starting Time
    public function setStartingTimeAttribute($value){
        $this->_started_at_date = $value;
        $this->set_starting_at();
    }

    //Duration Hour
    public function getDurationHourAttribute()
    {
        return floor($this->duration  /  60 );
    }

    //Duration Minute
    public function getDurationMinuteAttribute()
    {
        return $this->duration % 60;
    }

    protected $_duration_hour, $_duration_minute;

    protected function set_duration(){
        $this->duration = $this->_duration_hour * 60 + $this->_duration_minute;
    }

    //Duration Hour
    public function setDurationHourAttribute($value)
    {
        $this->_duration_hour = $value;
        $this->set_duration();
    }
    
    //Duration Minute
    public function setDurationMinuteAttribute($value)
    {
        $this->_duration_minute = $value;
        $this->set_duration();
    }

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
        return $this->belongsToMany(Room::class,'room_bookings')
            ->using(RoomBooking::class)
            ->as('room_booking')
            ->withPivot('room_id', 'booking_id')
            ->withTimestamps();
    }

    public function mentors(): BelongsToMany
    {
        return $this->belongsToMany(Mentor::class, 'mentor_bookings')
            ->using(MentorBooking::class)
            ->as('mentor_booking')
            ->withPivot('mentor_id', 'booking_id')
            ->withTimestamps();
    }
}
