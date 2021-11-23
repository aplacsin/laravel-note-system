<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $note_id
 * @property string $file
 */
class File extends Model
{
    protected $fillable = [
        'note_id', 'file'
     ];

    public function note()
    {
        return $this->belongsTo(Note::class, 'note_id', 'id');
    }
}
