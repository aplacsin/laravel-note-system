<?php

namespace App\Models;

use App\Enums\ImageDiskType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

/**
 * @property int $note_id
 * @property string $file
 * @property string $disk
 */
class File extends Model
{
    protected $fillable = [
        'note_id', 'file', 'disk'
     ];

    public static function boot() {
        parent::boot();
        self::deleting(function($file) {
            Storage::disk(ImageDiskType::public()->label)
                ->delete("files/$file->file");
        });
    }

    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'note_id', 'id');
    }
}
