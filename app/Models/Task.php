<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 * @property string|null $title
 * @property int $priority
 * @property string $status
 * @property string|null $completed_at
 */
class Task extends Model
{
    protected $fillable = [
        'user_id', 'title', 'priority', 'status', 'completed_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }
}
