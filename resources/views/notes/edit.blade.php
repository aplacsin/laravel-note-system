@extends('layouts.main')

@section('content')

<div class="mcw">
    <div class="container main-container">
        <div class="row">
            <div class="col-md-12 cards-center">
                <div class="cards-wrapper cards-create-note">
                    <div class="cards-header">
                        {{ __('func.edit_notes') }}
                    </div>
                    <!--Message alerts-->
                    @include('layouts.flash-message')
                    
                    <div class="pull-right">
                        <a class="btn btn-primary"
                            href="{{ route('notes.index', app()->getLocale()) }}">{{ __('func.back') }}</a>
                    </div>
                    <Form method="post" action="{{ route('notes.update', [app()->getLocale(), $note->id]) }}">                     
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" value="{{$note->title}}"
                                placeholder="{{ __('func.enter_title') }}"><br>
                            <textarea name="content" id="editor" cols="30" rows="10" class="form-control"
                                placeholder="{{ __('func.enter_content') }}"
                                maxlength="500">{{$note->content}}</textarea><br>
                            <div class="pull-center">
                                <button class="btn btn-success btn-create">{{ __('func.save') }}</button>
                            </div>
                        </div>
                    </Form>
                </div>
            </div>
        </div>
    </div>

    @endsection
