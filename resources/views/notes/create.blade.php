@extends('layouts.main')

@section('content')

<div class="mcw">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="create-wrapper">
                    <h3>Create Note</h3>
                    <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('notes.index', app()->getLocale()) }}">Back</a>
                    </div>
                    <Form method="post" action="{{ route('notes.store') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                                placeholder="Enter the title"><br>
                           
                            <div class="pull-center">
                                <button class="btn btn-success btn-create">Create</button>
                            </div>
                        </div>
                    </Form>
                </div>
            </div>
        </div>
    </div>

    @endsection
