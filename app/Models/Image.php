<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ImageDiskType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $note_id
 * @property string $image
 * @property string $disk
 */
class Image extends Model
{
    protected $fillable = [
        'note_id', 'image', 'disk'
     ];

    public static function boot() {
        parent::boot();
        self::deleting(function($image) {
            Storage::disk(ImageDiskType::public()->label)
                ->delete("images/$image->image");
        });
    }

    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'note_id', 'id');
    }

    public function setDiskAttribute($value)
    {
        $this->attributes['disk'] = ImageDiskType::from($value);
    }
}
