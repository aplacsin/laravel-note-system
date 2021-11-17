@extends('layouts.main')

@section('content')

<div class="mcw">
    <div class="container main-container">
        <div class="row">
            <div class="col-md-12 cards-center">
                <div class="cards-wrapper cards-create-note">
                    <div class="cards-header">
                        {{ __('func.add_notes') }}
                    </div>
                    <!--Message alerts-->
                    @include('layouts.flash-message')
                    <div class="pull-right">
                        <a class="btn btn-primary"
                            href="{{ route('notes.index', app()->getLocale()) }}">{{ __('func.back') }}</a>
                    </div>
                    <Form method="post" action="{{ route('notes.store', app()->getLocale()) }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                placeholder="{{ __('func.enter_title') }}"><br>
                            <textarea name="content" id="editor" cols="30" rows="10" class="form-control"
                                placeholder="{{ __('func.enter_content') }}"
                                maxlength="500">{{old('content')}}</textarea><br>

                            <div class="form-group">
                                <div class="wrapper-image">
                                    <span>
                                        <h5>{{ __('func.upload_image') }}
                                    </span></h5>
                                    <button class="btn btn-primary add-create-field add-create-image-field">{{ __('func.add_image') }} &nbsp;<span>+</span></button>
                                    <div><input class="add-file" type="file" name="image[]"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="wrapper-create-file">
                                    <span>
                                        <h5>{{ __('func.upload_file') }}
                                    </span></h5>
                                    <button class="btn btn-primary add-create-field add-create-file-field">{{ __('func.add_file') }} &nbsp;<span>+</span></button>
                                    <div><input class="add-file" type="file" name="file[]"></div>
                                </div>
                            </div>
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
