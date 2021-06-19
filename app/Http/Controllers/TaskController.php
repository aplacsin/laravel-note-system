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
        if (Auth::check()) {  
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

            $tasks = $tasks->orderBy('created_at', 'DESC')->get();
       
            return view('tasks.index', compact('tasks'));  
        }
        else
        {
            return redirect()->route('login', app()->getLocale());
        }      
    }

    public function create()
    {
        if (Auth::check()) {  
            return view('tasks.create');
        }
        else
        {
            return redirect()->route('login', app()->getLocale());
        }
    }

    public function store(StoreTaskRequest $request)
    {
        $userId = auth()->user()->id;

        $task = $request->all();
        $task['user_id'] = $userId;
        Task::create($task);

        // Redirect to index
       return redirect()->route('tasks.index', app()->getLocale())
                        ->with('success', trans('alert.success_created_task'));
    }

    public function destroy($id) 
    {
        Task::findorfail($id)->delete();

        // Redirect to index
        return redirect()->back()
                         ->with('success', trans('alert.success_delete_task'));
    }

    public function getCompleted($id)
    {        
        $id = \Request::segment(3);        
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
        return redirect()->route('tasks.index', app()->getLocale())
                         ->with('success', trans('alert.success_complete_task'));
    }

    public function completed()
    {
        if (Auth::check()) {  
            $userId = auth()->user()->id;

            $tasks = Completed::query()
            ->where('user_id', $userId)
            ->orderBy('updated_at', 'DESC')
            ->paginate(15);
       
            return view('tasks.completed', compact('tasks'));
        }
        else
        {
            return redirect()->route('login', app()->getLocale());
        }
    }

    public function destroyCompleted($id)
    {      
        Completed::findorfail($id)->delete();

        // Redirect to index
        return redirect()->back()
                         ->with('success', trans('alert.success_deleted'));
    }
}