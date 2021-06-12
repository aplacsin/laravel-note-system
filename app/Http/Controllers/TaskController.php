<?php

namespace App\Http\Controllers;

use App;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Task;
use App\Models\User;
use App\Models\Completed;
use DateTime;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\FilterTaskRequest;

class TaskController extends Controller
{
    use AuthenticatesUsers;

    public function index(FilterTaskRequest $request)
    {        
        $title = $request->title;
        $priority = $request->priority;
        $sort = $request->sort;
        $method = $request->method_sort;

        $userId = auth()->user()->id;
       
        $tasks = Task::query()
        ->where('user_id', $userId);       

        if ($request->has('title')) {
             $tasks->where('title', 'like', "%{$title}%");
        }

        if ($request->get('priority')) {
            $tasks->where('priority', $priority);            
        }

        if ($request->get('sort')) {
            $tasks->orderBy("{$sort}", "{$method}");
        }

        $tasks = $tasks->get();
       
        return view('tasks.index', compact('tasks'));        
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(StoreTaskRequest $request)
    {
        $userId = auth()->user()->id;

        $task = $request->all();
        $task['user_id'] = $userId;
        Task::create($task);

        // Redirect to index
       return redirect()->route('tasks.index')
                        ->with('success','• The task has been successfully created.');
    }

    public function destroy($id) 
    {
        Task::findorfail($id)->delete();

        // Redirect to index
        return redirect()->route('tasks.index')
                         ->with('success','• The task was successfully deleted.');
    }

    public function getCompleted($id)
    {
        $task = Task::where('id', $id)->first();
        $user_id = $task->user_id;
        $title = $task->title;
        $priority = $task->priority;
        $status = $task->status;
        $task->delete();

        $currentDate = date("Y-m-d H:i:s");

        $completed = new Completed();
        $completed->user_id = $user_id;
        $completed->title = $title;
        $completed->priority = $priority;
        $completed->status = 'Completed';
        $completed->completed_at = $currentDate;
        $completed->save();

        // Redirect to index
        return redirect()->route('tasks.index')
                         ->with('success','• Task has been completed successfully.');
    }

    public function completed()
    {
        $userId = auth()->user()->id;

        $tasks = Completed::query()
        ->where('user_id', $userId)
        ->get();
       
        return view('tasks.completed', compact('tasks'));
    }

    public function destroyCompleted($id)
    {
        Completed::findorfail($id)->delete();

        // Redirect to index
        return redirect()->route('tasks.completed')
                         ->with('success','• Successfully deleted.');
    }
}