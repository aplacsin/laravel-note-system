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

                    <table class="table table-stripped">
                        <tbody>
                            <tr>
                                <td><b>{{ __('func.action') }}</b></td>
                            <td><b>{{ __('func.title') }}</b></i></td>
                            <td><b>{{ __('func.priority') }}</b></td>
                            <td><b>{{ __('func.status') }}</b></td>
                            <td><b>{{ __('func.completed_at') }}</b></td>
                            </tr>
                            @foreach($tasks as $task)
                            <tr>
                                <td>
                                    <Form method="POST"
                                        action="{{ route('tasks.destroyCompleted', [$task->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="button-action"><i class="fa fa-trash icons icons-delete"
                                                aria-hidden="true"></i></button>
                                    </Form>
                                </td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->priority }}</td>
                                <td>{{ $task->status }}</td>
                                <td>{{ $task->completed_at }}</td>
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
