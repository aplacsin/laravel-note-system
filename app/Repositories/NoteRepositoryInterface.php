<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Note;

interface NoteRepositoryInterface
{
    public function findByUserId(int $userId): LengthAwarePaginator;

    public function save(Note $note): Note;

    public function removeById(int $id): void;

    public function findById(int $id): ?Note;
}
