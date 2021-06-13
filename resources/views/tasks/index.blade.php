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
                        <a href="{{ route('tasks.create', app()->getLocale()) }}" class="btn btn-success">{{ __('func.add_task') }}</a>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse"
                            aria-expanded="false" aria-controls="collapse">
                            {{ __('func.filter') }}
                        </button>
                    </div>
                    <Form method="get" action="{{ route('tasks.index', app()->getLocale()) }}">
                        @csrf
                        <div class="collapse" id="collapse">
                            <div class="form-group">
                                <input class="form-control" name="title" value="{{ old('title') }}"
                                    placeholder="{{ __('func.title_serch') }}"><br>
                                <div class="selected-wrapper">
                                    <select name="priority" class="form-control">
                                        <option disabled selected>{{ __('func.select_priority') }}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                    <select name="sort" class="form-control">
                                        <option disabled selected>{{ __('func.select_sort') }}</option>
                                        <option value="priority">{{ __('func.priority') }}</option>
                                        <option value="created_at">{{ __('func.created_at') }}</option>
                                    </select>
                                    <select name="method_sort" class="form-control">
                                        <option value="asc" selected>{{ __('func.asc') }}</option>
                                        <option value="desc">{{ __('func.desc') }}</option>
                                    </select>
                                </div>
                                <div class="pull-center">
                                    <button class="btn btn-primary">{{ __('func.filtered') }}</button>
                                </div>
                            </div>
                    </Form>
                </div>

                <table class="table table-stripped">
                    <tbody>
                        <tr>
                            <td><b>{{ __('func.action') }}</b></td>
                            <td><b>{{ __('func.title') }}</b></i></td>
                            <td><b>{{ __('func.priority') }}</b></td>
                            <td><b>{{ __('func.status') }}</b></td>
                            <td><b>{{ __('func.created_at') }}</b></td>
                        </tr>
                        @foreach($tasks as $task)
                        <tr>
                            <td class="action-wp">
                                <Form method="GET" action="{{ route('tasks.getCompleted', [app()->getLocale(), $task->id]) }}">
                                    @csrf
                                    <button class="button-action"><i class="fa fa-check icons icons-complete"
                                            aria-hidden="true"></i></button>
                                </Form>
                                <Form method="POST" action="{{ route('tasks.destroy', [$task->id]) }}"> 
                                                               
                                    @method('DELETE')
                                    @csrf
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
