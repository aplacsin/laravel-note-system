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
                    <Form method="post" action="{{ route('notes.update', [app()->getLocale(), $note->id]) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" value="{{$note->title}}"
                                placeholder="{{ __('func.enter_title') }}"><br>
                            <textarea name="content" id="editor" cols="30" rows="10" class="form-control"
                                placeholder="{{ __('func.enter_content') }}"
                                maxlength="500">{{$note->content}}</textarea><br>
                            <div class="form-group">
                                <div class="wrapper-edit-image-form">
                                    <span>
                                        <h5>{{ __('func.upload_image') }}
                                    </span></h5>
                                    <button class="btn btn-primary add-edit-image-field"
                                        id="add-create-field">{{ __('func.add_image') }} &nbsp;<span>+</span></button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="wrapper-edit-file-form">
                                    <span>
                                        <h5>{{ __('func.upload_file') }}
                                    </span></h5>
                                    <button class="btn btn-primary add-edit-file-field"
                                        id="add-create-field">{{ __('func.add_file') }} &nbsp;<span>+</span></button>
                                </div>
                            </div>
                            <div class="pull-center">
                                <button class="btn btn-success btn-create">{{ __('func.save') }}</button>
                            </div>
                        </div>
                    </Form>
                    @if (count($note->image) > 0)
                    <div class="title-upload-image">
                        <span>{{ __('func.uploaded_images') }}:</h5>
                        </span>
                    </div>
                    <div class="wrapper-img">
                        @foreach($note->image as $img)

                        <div class="wrapper-image-edit">
                            <div class="image-edit" id="image-edit">
                                <img src="{{ url('images/'.$img->image)}}" alt="{{ $img->image }}">
                            </div>
                            <div class="btn-edit-delete">
                                <button class="btn btn-danger edit-delete edit-image-delete"
                                    data-id="{{ $img->id }}">{{ __('func.delete') }}</button>
                            </div>
                        </div>

                        @endforeach
                    </div>
                    @else

                    @endif

                    @if (count($note->file) > 0)
                    <div class="title-upload-file">
                        <span>{{ __('func.uploaded_files') }}:
                        </span>
                    </div>
                    <div class="wrapper-file">
                        @foreach($note->file as $file)

                        <div class="wrapper-file-edit">
                            <div class="file-edit" id="file-edit">
                                <i class="fa fa-file" aria-hidden="true"><span
                                        class="name-file">{{ $file->file }}</span></i>
                            </div>
                            <div class="btn-edit-delete">
                                <button class="btn btn-danger edit-delete edit-file-delete"
                                    data-id="{{ $file->id }}">{{ __('func.delete') }}</button>
                            </div>
                        </div>

                        @endforeach
                    </div>
                    @else

                    @endif
                </div>
            </div>
        </div>
    </div>

    @endsection
