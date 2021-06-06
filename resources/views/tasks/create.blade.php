@extends('layouts.main')

@section('content')

<div class="container">
    <h3>Create Task</h3>

    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('tasks.index') }}">Back</a>
            </div>            
            <Form method="post" action="{{ route('tasks.store') }}">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}"
                        placeholder="Enter the title"><br>
                    <select name="priority" class="form-control">
                        <option selected>Select Priority</option>
                        <option name="priority" value="1">1</option>
                        <option name="priority" value="2">2</option>
                        <option name="priority" value="3">3</option>
                        <option name="priority" value="4">4</option>
                        <option name="priority" value="5">5</option>
                    </select>
                    <div class="pull-center">
                        <button class="btn btn-success">Create</button>
                    </div>
                </div>
            </Form>

        </div>
    </div>

    @endsection
