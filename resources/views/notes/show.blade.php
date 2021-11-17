@extends('layouts.main')

@section('content')

<div class="mcw">
    <div class="container main-container">
        <div class="row">
            <div class="col-md-12 cards-center">
                <div class="cards-wrapper cards-create-note">
                    <div class="cards-header">
                        {{ __('func.show_notes') }}
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-primary"
                            href="{{ route('notes.index', app()->getLocale()) }}">{{ __('func.back') }}</a>
                    </div>
                    <div class="form-group-show">
                        <div class="wrapper-title">
                            <h3 class="title-show">
                                <h4>{{ __('func.title_note') }}</h4>
                                {{ $note->title }}
                            </h3>
                        </div>
                        <div class="wrapper-content">
                            <h4>{{ __('func.content_note') }}</h4>
                            {!! $note->content !!}
                        </div>
                        @if (count($note->image) > 0)
                        <div class="wrapper-image">
                            <h4>{{ __('func.image') }}</h4>
                        </div>
                        <div class="wrapper-img" id="thumbs">
                            @isset($note->image)
                            @foreach($note->image as $img)
                            <div class="wrapper-image-show">
                                <div class="image-show">
                                    <figure><a href="{{ url('images/'.$img->image) }}" alt="{{ $img->image }}"
                                            title="{{ $img->image }}">
                                            <img src="{{ url('images/'.$img->image)}}" alt="{{ $img->image }}">
                                        </a></figure>
                                </div>
                            </div>
                            @endforeach
                            @endisset
                        </div>
                        @else
                        @endif

                        @if (count($note->file) > 0)
                        <div class="title-wrapper-file">
                            <h4>{{ __('func.file') }}</h4>
                        </div>
                        <div class="wrapper-file">
                            @isset($note->file)
                            @foreach($note->file as $file)
                            <div class="wrapper-file-show">
                                <div class="file-show">
                                    <i class="fa fa-file" aria-hidden="true"><span class="name-file">{{ $file->file }}</span></i>
                                    <a class="file-link" href="{{ url('files/'.$file->file)}}"><i class="fa fa-download" aria-hidden="true"></i></a>
                                </div>
                            </div>
                            @endforeach
                            @endisset
                        </div>
                        @else
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection
