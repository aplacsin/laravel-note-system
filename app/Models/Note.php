<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $user_id
 * @property string|null $title
 * @property string|null $content
 */
class Note extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content', 'created_at'
     ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function image(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function file(): HasMany
    {
        return $this->hasMany(File::class);
    }

}
