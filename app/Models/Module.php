<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'has_exam',
        'has_solve',
        'has_lecture',
        'has_feedback',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'has_exam' => 'boolean',
        'has_solve' => 'boolean',
        'has_lecture' => 'boolean',
        'has_feedback' => 'boolean',
    ];

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class, 'module_topic');
    }

    public function batches(): HasMany
    {
        return $this->hasMany(Batch::class);
    }
}
