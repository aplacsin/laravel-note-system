<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $user_id
 * @property string $title
 * @property int $priority
 * @property string $status
 * @property Carbon|null $completed_at
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
