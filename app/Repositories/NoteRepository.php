<?php

namespace App\Repositories;

use App\Models\Note;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Support\Collection;

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
       Note::query()
           ->findOrfail($id)
           ->delete();
    }

    /**
     * @throws NotFound
     */
    public function findById(int $id): ?Note
    {
        $model = Note::query()
            ->findorfail($id);

        if(!$model) {
            throw new NotFound();
        }

        /** @var Note $model */
        return $model;
    }
}
