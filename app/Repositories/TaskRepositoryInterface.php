<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface TaskRepositoryInterface
{
    public function save(Task $task): Task;

    public function removeById(int $id): void;

    public function findById(int $id);

    public function list(array $filter): Collection;

    public function findCompleteByUserId(int $userId): LengthAwarePaginator;
}
