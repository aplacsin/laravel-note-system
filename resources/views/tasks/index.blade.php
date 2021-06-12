@extends('layouts.main')

@section('content')


<!--main content wrapper-->
<div class="mcw">
    <!-- Message success -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <!-- Message errors -->
    @if ($message = Session::get('errors'))
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
    @endif
    <!--navigation here-->
    <!--main content view-->
    <div class="container">
        <div class="row">
            <div class="col-md-12 content-center">

                <div class="wrapper-tasks">

                    <div class="wrapper-button">
                        <a href="{{ route('tasks.create') }}" class="btn btn-success">Add Task</a>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse"
                            aria-expanded="false" aria-controls="collapse">
                            Filter
                        </button>
                    </div>
                    <Form method="get" action="{{ route('tasks.index') }}">
                        @csrf
                        <div class="collapse" id="collapse">
                            <div class="form-group">
                                <input class="form-control" name="title" value="{{ old('title') }}" placeholder="Title Search..."><br>
                                <select name="priority" class="form-control">
                                    <option disabled selected>Selected Priority</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <select name="sort" class="form-control">  
                                    <option disabled selected>Selected Sort</option>                                 
                                    <option value="priority">Priority</option>
                                    <option value="created_at">Created Task</option>
                                </select>
                                <select name="method_sort" class="form-control">                                                                   
                                    <option value="asc" selected>Ascending</option>
                                    <option value="desc">Descending</option>
                                </select>
                                <div class="pull-center">
                                    <button class="btn btn-primary">Filtered</button>
                                </div>
                            </div>
                    </Form>
                </div>

                <table class="table table-stripped">
                    <tbody>
                        <tr>
                            <td><b>Action</b></td>
                            <td><b>Title</b></i></td>
                            <td><b>Priority</b></td>
                            <td><b>Status</b></td>
                            <td><b>Create Date</b></td>
                        </tr>
                        @foreach($tasks as $task)
                        <tr>
                            <td class="action-wp">
                                <Form method="GET" action="{{ route('tasks.getCompleted', $task->id) }}">
                                    @csrf
                                    <button class="button-action"><i class="fa fa-check icons icons-complete"
                                            aria-hidden="true"></i></button>
                                </Form>
                                <Form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="button-action"><i class="fa fa-trash icons icons-delete"
                                            aria-hidden="true"></i></button>
                                </Form>
                            </td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->priority }}</td>
                            <td>{{ $task->status }}</td>
                            <td>{{ $task->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
