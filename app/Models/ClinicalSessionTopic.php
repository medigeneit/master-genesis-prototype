<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClinicalSessionTopic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'clinical_id',
        'topic_id',
        'session_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'clinical_id' => 'integer',
        'topic_id' => 'integer',
        'session_id' => 'integer',
    ];

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function clinical(): BelongsTo
    {
        return $this->belongsTo(FacultyDiscipline::class);
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

    public function facultyDisciplines(): HasMany
    {
        return $this->hasMany(FacultyDiscipline::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }
}
