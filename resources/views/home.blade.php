@extends('layouts.main')

@section('content')

<div class="mcw">
    <div class="container main-container">
        <div class="row">
            <div class="col-md-12 cards-center">
                <div class="cards-wrapper">
                    <div class="cards-header">{{ __('func.Welcome,')  }} {{ Auth::user()->name }}</div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <div class="card-body">{{ __('func.Info')  }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
