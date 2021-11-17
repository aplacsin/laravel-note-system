<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use App\Models\Note;

class NoteRepository implements NoteRepositoryInterface
{
    public function findNotesByUserId(int $userId): Collection
    {
        return Note::query()
        ->where('user_id', $userId)
        ->orderBy('created_at', 'DESC')
        ->get();
    }

    public function save(Note $note): Note
    {
        $note->save();
        return $note;
    }

    public function removeById(int $id): void
    {
       Note::findOrfail($id)->delete();
    }

    public function findById(int $id): Note
    {
        return Note::findorfail($id);
    }
}