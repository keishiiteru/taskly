<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskRecurrence extends Model
{
    use SoftDeletes;

     protected $fillable = [
        'task_id',
        'frequency',
        'interval',
        'days_of_week',
        'starts_at',
        'ends_at',
        'last_generated_at',
    ];

     protected $casts = [
        'days_of_week'       => 'array',
        'starts_at'          => 'date',
        'ends_at'             => 'date',
        'last_generated_at'  => 'datetime',
        'interval'           => 'integer',
    ];

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }

}
