<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class TaskService
{
    private TaskRepository $taskRepository;
    private TaskCreator $taskCreator;

    public function __construct(TaskRepository $taskRepository, TaskCreator $taskCreator)
    {
        $this->taskRepository = $taskRepository;
        $this->taskCreator = $taskCreator;
    }

    public function create(array $task)
    {
        $this->taskCreator->create($task);
    }

    public function deleteById(int $id): void
    {
        $this->taskRepository->removeById($id);
    }

    public function list(array $filter): Collection
    {
        return $this->taskRepository->list($filter);
    }

    public function getCompleteByUserId(int $userId): LengthAwarePaginator
    {
        return $this->taskRepository->findCompleteByUserId($userId);
    }

    public function complete(int $id): Task
    {
        $task = $this->taskRepository->findById($id);
        $currentDate = Carbon::now()->format("Y-m-d H:i:s");

        /**
         * @var Task $task
         **/
        $task->status = 'Completed';
        $task->completed_at = $currentDate;

        return $this->taskRepository->save($task);
    }
}
