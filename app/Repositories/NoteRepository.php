<?php

namespace App\Repositories;

use App\Models\Note;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Pagination\LengthAwarePaginator;

class NoteRepository implements NoteRepositoryInterface
{
    public function findByUserId(int $userId): LengthAwarePaginator
    {
        return Note::query()
        ->where('user_id', $userId)
        ->orderBy('created_at', 'DESC')
        ->paginate(15);
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
