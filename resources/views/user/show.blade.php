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
                    <div class="panel-body">
                        Gold: {{ $user->gold }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Owner of the following ships:
                    </div>
                    <div class="panel-body">
                        <p class="text-center">
                        <ul>
                            @foreach ($user->myShips() as $ship)
                            <li>
                                <a href="{{ $ship->path() }}">{{ $ship->name }}</a>, a {{ $ship->length }} footer with {{ $ship->decks }} decks and {{ $ship->crew()->count() }} sailors.
                            </li>
                            @endforeach
                        </ul>
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
