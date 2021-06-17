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

                <div class="wrapper-tasks completed-table">

                    <table class="">
                        <thead>
                            <tr>
                                <th scope="col"><b>{{ __('func.action') }}</b></th>
                                <th scope="col"><b>{{ __('func.title_task') }}</b></th>
                                <th scope="col"><b>{{ __('func.priority') }}</b></th>
                                <th scope="col"><b>{{ __('func.status') }}</b></th>
                                <th scope="col"><b>{{ __('func.completed_at') }}</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                            <tr>
                                <td data-label="{{ __('func.action') }}">
                                    <div class="action-wp">
                                        <Form method="POST" action="{{ route('tasks.destroyCompleted', [app()->getLocale(), $task->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="button-action"><i class="fa fa-trash icons icons-delete"
                                                    aria-hidden="true"></i></button>
                                        </Form>
                                </td>
                                <td class="table-title" data-label="{{ __('func.title_task') }}">{{ $task->title }}</td>
                                <td data-label="{{ __('func.priority') }}">{{ $task->priority }}</td>
                                <td data-label="{{ __('func.status') }}">{{ $task->status }}</td>
                                <td data-label="{{ __('func.completed_at') }}">{{ $task->completed_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{ $tasks->links() }}
    </div>
</div>

@endsection
