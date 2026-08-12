<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskOccurrence extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'task_id',
        'is_completed',
    ];

    protected $casts = [
        'is_completed' => 'boolean',
    ];

    /**
     * The task this occurrence belongs to.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
