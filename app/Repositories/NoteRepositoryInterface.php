<?php

namespace App\Repositories;

use Illuminate\Support\Collection;
use App\Models\Note;

interface NoteRepositoryInterface
{
    public function findNotesByUserId(int $userId): Collection;

    public function save(Note $note): Note;

    public function removeById(int $id): void;

    public function findById(int $id): ?Note;
}
