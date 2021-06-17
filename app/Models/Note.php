<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content', 'created_at'
     ];


    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }
}
