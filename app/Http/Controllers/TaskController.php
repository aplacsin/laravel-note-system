<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App;
use App\Services\TaskService;
use App\DTO\TaskDTO;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\FilterTaskRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    private TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(FilterTaskRequest $request)
    {
        $userId = Auth::id();

        $filter = [
            'user_id' => $userId,
            'title' => $request->input('title'),
            'priority' => $request->input('priority'),
            'sort' => $request->input('sort'),
            'method' => $request->input('method'),
        ];

        $tasks = $this->taskService->list($filter);

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $taskDTO = TaskDTO::make(
            Auth::id(),
            $request->getTitle(),
            $request->getPriority(),
        );

        $this->taskService->create($taskDTO);

        return redirect()->route('tasks.index', app()->getLocale())
                        ->with('success', trans('alert.success_created_task'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->taskService->deleteById($id);

        return redirect()->back()
                         ->with('success', trans('alert.success_delete_task'));
    }

    public function complete(int $id): RedirectResponse
    {
        $this->taskService->complete($id);

        return redirect()->route('tasks.index', app()->getLocale())
                         ->with('success', trans('alert.success_complete_task'));
    }

    public function getComplete()
    {
        $userId = Auth::id();
        $tasks = $this->taskService->getCompleteByUserId($userId);

        return view('tasks.completed', compact('tasks'));
    }

    public function removeComplete(int $id): RedirectResponse
    {
        $this->taskService->deleteById($id);

        return redirect()->back()
                         ->with('success', trans('alert.success_deleted'));
    }
}
