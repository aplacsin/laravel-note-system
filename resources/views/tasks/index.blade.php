@extends('layouts.main')

@section('content')


<!--main content wrapper-->
<div class="mcw">
    <!--navigation here-->
    <!--main content view-->

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

    <div class="wrapper-button">
        <a href="{{ route('tasks.create') }}" class="btn btn-success">Создать</a>
    </div>

    <div class="cv">
        <div class="inbox">
            <div class="inbox-bx container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <table class="table table-stripped">
                            <tbody>
                                <tr>
                                    <td><b>Action</b></td>
                                    <td><b>Title</b></i></td>
                                    <td><b>Priority</b></td>
                                    <td><b>Status</b></td>
                                    <td><b>Date</b></td>
                                </tr>
                                @foreach($tasks as $task)
                                <tr>
                                    <td>
                                        <Form method="GET" action="{{ route('tasks.getCompleted', $task->id) }}">
                                            @csrf
                                            <button><i class="fa fa-check" aria-hidden="true"></i></button>
                                        </Form>
                                        <Form method="POST" action="{{ route('tasks.destroy', $task->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button><i class="fa fa-trash" aria-hidden="true"></i></button>
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
</div>

@endsection
