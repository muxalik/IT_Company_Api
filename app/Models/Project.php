<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes, Prunable;

    protected $fillable = [
        'name',
        'leader_id',
        'total_tasks',
        'tasks_done',
        'total_hours',
        'wasted_hours',
        'created_at',
        'updated_at'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['is_favourite', 'total_tasks', 'tasks_done', 'total_hours', 'wasted_hours'])
            ->withTimestamps();
    }

    public function prunable()
    {
        return static::where('created_at', '<=', now()->subYears(3));
    }
}
