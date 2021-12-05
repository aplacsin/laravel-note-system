<?php

namespace App\Services;

use App\DTO\TaskDTO;
use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskCreator
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function create(TaskDTO $dto): Task
    {
        $task = new Task();
        $task->user_id = $dto->getUserId();
        $task->title = $dto->getTitle();
        $task->priority = $dto->getPriority();

        return $this->taskRepository->save($task);
    }
}
