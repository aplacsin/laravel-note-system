<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Task;
use App\Models\User;
use App\Models\Completed;
use DateTime;

class TaskController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {        
        $userId = auth()->user()->id;

        $tasks = Task::query()
        ->where('user_id', $userId)
        ->get();       
       
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $userId = auth()->user()->id;

        $task = $request->all();
        $task['user_id'] = $userId;
        Task::create($task);

        // Redirect to index
       return redirect()->route('tasks.index')
                        ->with('success','• The note has been successfully created.');
    }

    public function destroy($id) 
    {
        Task::findorfail($id)->delete();

        // Redirect to index
        return redirect()->route('tasks.index')
                         ->with('success','• The note was successfully deleted.');
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
        $completed->status = 'done';
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
}
