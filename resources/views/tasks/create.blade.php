@extends('layouts.main')

@section('content')

<div class="mcw">
    <div class="container main-container">
        <div class="row">
            <div class="col-md-12 cards-center">
                <div class="cards-wrapper">
                    <div class="cards-header">
                        {{ __('func.add_task') }}
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('tasks.index', app()->getLocale()) }}">{{ __('func.back') }}</a>
                    </div>
                    <Form method="post" action="{{ route('tasks.store', app()->getLocale()) }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                placeholder="{{ __('func.enter_title') }}"><br>
                            <select name="priority" class="form-control">
                                <option selected>{{ __('func.select_priority') }}</option>
                                <option name="priority" value="1">1</option>
                                <option name="priority" value="2">2</option>
                                <option name="priority" value="3">3</option>
                                <option name="priority" value="4">4</option>
                                <option name="priority" value="5">5</option>
                            </select>
                            <div class="pull-center">
                                <button class="btn btn-success btn-create">{{ __('func.create') }}</button>
                            </div>
                        </div>
                    </Form>
                </div>
            </div>
        </div>
    </div>

    @endsection
