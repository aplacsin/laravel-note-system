@extends('layouts.main')

@section('content')


<!--main content wrapper-->
<div class="mcw">
    <!--Message alerts-->
    @include('layouts.flash-message')
    <!--navigation here-->
    <!--main content view-->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="wrapper-tasks">
                    <div class="wrapper-button">
                        <a href="{{ route('tasks.create', app()->getLocale()) }}"
                            class="btn btn-success">{{ __('func.add_task') }}</a>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse"
                            aria-expanded="false" aria-controls="collapse">
                            {{ __('func.filter') }}
                        </button>
                    </div>
                    @if (count($tasks) > 0)
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
                <table>
                    <thead>
                        <tr>
                            <th scope="col"><b>{{ __('func.action') }}</b></th>
                            <th scope="col"><b>{{ __('func.title_task') }}</b></th>
                            <th scope="col"><b>{{ __('func.priority') }}</b></th>
                            <th scope="col"><b>{{ __('func.status') }}</b></th>
                            <th scope="col"><b>{{ __('func.created_at') }}</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td data-label="{{ __('func.action') }}">
                                <div class="action-wp">
                                    <Form method="GET"
                                        action="{{ route('tasks.getCompleted', [app()->getLocale(), $task->id]) }}">
                                        @csrf
                                        <button class="button-action flex-column"><i
                                                class="fa fa-check icons icons-complete"
                                                aria-hidden="true"></i></button>
                                    </Form>
                                    <Form method="POST"
                                        action="{{ route('tasks.destroy', [app()->getLocale(), $task->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('{{ __('func.confirm_delete') }}')" class="button-action flex-column"><i
                                                class="fa fa-trash icons icons-delete" aria-hidden="true"></i></button>
                                    </Form>
                                </div>
                            </td>
                            <td class="table-title" data-label="{{ __('func.title_task') }}">{{ $task->title }}</td>
                            <td data-label="{{ __('func.priority') }}">{{ $task->priority }}</td>
                            <td data-label="{{ __('func.status') }}">{{ $task->status }}</td>
                            <td data-label="{{ __('func.created_at') }}">{{ $task->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="wrapper-not-alert">
                    {{ __('func.no_tasks') }}
                </div>
                @endif
            </div>
        </div>
        {{--   {{ $tasks->links() }} --}}
    </div>
</div>
</div>

@endsection
