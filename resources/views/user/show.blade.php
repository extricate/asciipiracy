@extends('layouts.app')

@section('title', $user->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ $user->path() }}">{{ $user->id }}</a>
                        {{ $user->name }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <p class="text-center">
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            </div>
        </div>

        @auth
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                </div>
            </div>
        @endauth
    </div>
@endsection
