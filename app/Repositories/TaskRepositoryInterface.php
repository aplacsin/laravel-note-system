<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TaskRepositoryInterface
{
    public function save(Task $task): Task;

    public function removeById(int $id): void;

    public function findById(int $id);

    public function list(array $filter): LengthAwarePaginator;

    public function findCompleteByUserId(int $userId): LengthAwarePaginator;
}
