<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Session extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id',
        'year',
        'name',
        'starting',
        'ending',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'course_id' => 'integer',
        'year' => 'integer',
        'starting' => 'datetime',
        'ending' => 'datetime',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class)
            ->using(ClinicalSessionTopic::class)
            ->as('clinical_session_topic')
            ->withPivot('id', 'clinical_id', 'topic_id', 'session_id')
            ->withTimestamps();
    }

    public function batches(): HasMany
    {
        return $this->hasMany(Batch::class);
    }

    public function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    }
}
