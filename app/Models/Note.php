<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $content
 */
class Note extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content', 'created_at'
     ];

    public static function boot() {
        parent::boot();
        self::deleting(function($note) {
            foreach($note->image as $image) {
                $image->delete();
            }

            foreach($note->file as $file) {
                $file->delete();
            }
        });
    }

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
