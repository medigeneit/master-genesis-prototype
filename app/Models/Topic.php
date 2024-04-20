<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Topic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type' => 'integer',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }

    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'module_topic');
    }

    public function sessions(): BelongsToMany
    {
        return $this->belongsToMany(Session::class)
            ->using(ClinicalSessionTopic::class)
            ->as('clinical_session_topic')
            ->withPivot('id', 'clinical_id', 'topic_id', 'session_id')
            ->withTimestamps();
    }
}
