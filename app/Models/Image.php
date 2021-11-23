<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property int $note_id
 * @property string $image
 */
class Image extends Model
{
    protected $fillable = [
        'note_id', 'image'
     ];

    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'note_id', 'id');
    }
}
