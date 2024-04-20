<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Batch extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'session_id',
        'module_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'session_id' => 'integer',
        'module_id' => 'integer',
    ];

    public function doctorBatches(): HasMany
    {
        return $this->hasMany(DoctorBatch::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class)
            ->using(DoctorBatch::class)
            ->as('doctor_batch')
            ->withPivot('id', 'doctor_id', 'batch_id')
            ->withTimestamps();
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
