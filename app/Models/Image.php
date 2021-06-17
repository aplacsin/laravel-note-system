<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'note_id', 'image'
     ];

    public function note()
    {
        return $this->belongsTo(Note::class, 'note_id', 'id');
    }
}
