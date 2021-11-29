<?php

namespace App\Services;

use App\Models\Task;
use App\Repositories\TaskRepository;

class TaskCreator
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function create(array $data): Task
    {
        $task = new Task();
        $task->user_id = $data['user_id'];
        $task->title = $data['title'];
        $task->priority = $data['priority'];

        return $this->taskRepository->save($task);
    }
}
