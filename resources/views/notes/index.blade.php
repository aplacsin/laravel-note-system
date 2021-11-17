@extends('layouts.main')

@section('content')


<!--main content wrapper-->
<div class="mcw">
    <!--Message alerts-->
    @include('layouts.flash-message')
    <!--navigation here-->
    <!--main content view-->
    <div class="container table-container">
        <div class="row">
            <div class="col-md-12 ">
                <div class="wrapper-tasks">
                    <div class="wrapper-button">
                        <a href="{{ route('notes.create', app()->getLocale()) }}"
                            class="btn btn-success">{{ __('func.add_notes') }}</a>
                        {{--  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse"
                            aria-expanded="false" aria-controls="collapse">
                            {{ __('func.filter') }}
                        </button> --}}
                    </div>
                    {{-- <Form method="get" action="{{ route('tasks.index', app()->getLocale()) }}">
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
                        </Form> --}}
                    </div>
                    @if (count($notes) > 0)
                    <table>
                        <thead>
                            <tr>
                                <th scope="col"><b>{{ __('func.title_note') }}</b></th>
                                <th scope="col"><b>{{ __('func.content_note') }}</b></th>
                                <th scope="col"><b>{{ __('func.files') }}</b></th>
                                <th scope="col"><b>{{ __('func.image') }}</b></th>
                                <th scope="col"><b>{{ __('func.created_at') }}</b></th>
                                <th scope="col"><b>{{ __('func.action') }}</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notes as $note)
                            <tr>
                                <td class="table-title" data-label="{{ __('func.title_note') }}">{{ $note->title }}</td>
                                <td class="table-title" data-label="{{ __('func.content_note') }}">{!! $note->content
                                    !!}</td>
                                <td data-label="{{ __('func.files') }}">

                                    @if (count($note->file) > 0)
                                    {{ __('func.there_are_files') }}
                                    @else
                                    {{ __('func.no') }}
                                    @endif

                                </td>
                                <td data-label="{{ __('func.image') }}">

                                    @if (count($note->image) > 0)
                                    {{ __('func.there_are_images') }}
                                    @else
                                    {{ __('func.no') }}
                                    @endif

                                </td>
                                <td data-label="{{ __('func.created_at') }}">{{ $note->created_at }}</td>
                                <td data-label="{{ __('func.action') }}">
                                    <div class="action-wp">
                                        <Form method="GET"
                                            action="{{ route('notes.show', [app()->getLocale(), $note->id]) }}">
                                            @csrf
                                            <button class="button-action flex-column"><i
                                                    class="fa fa-eye icons icons-show" aria-hidden="true"></i></button>
                                        </Form>
                                        <Form method="GET"
                                            action="{{ route('notes.edit', [app()->getLocale(), $note->id]) }}">
                                            @csrf
                                            <button class="button-action flex-column"><i
                                                    class="fa fa-pencil icons icons-edit"
                                                    aria-hidden="true"></i></button>
                                        </Form>
                                        <Form method="POST"
                                            action="{{ route('notes.destroy', [app()->getLocale(), $note->id]) }}">
                                            @method('DELETE')
                                            @csrf
                                            <button onclick="return confirm('{{ __('func.confirm_delete') }}')"
                                                class="button-action flex-column"><i
                                                    class="fa fa-trash icons icons-delete"
                                                    aria-hidden="true"></i></button>
                                        </Form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="wrapper-not-alert">
                        {{ __('func.no_notes') }}
                    </div>
                    @endif
                </div>
            </div>
            {{--   {{ $tasks->links() }} --}}
        </div>
    </div>
</div>

@endsection
