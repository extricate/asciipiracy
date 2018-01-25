@extends('layouts.app')

@section('title', 'Dashboard')

@php
    $user = auth()->user();
    $active = $user->activeShip();
@endphp

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @if ($active != null)
                        <p>Welcome back capt'n <b>{{ $user->name }}</b>.
                        You're currently on the
                        <a href="{{ $active->path() }}"><b>{{ $active->name }}</b></a>, and its {{ $active->crew->count() }} sailors are ready for your command.
                        </p>
                        <p class="text-center">
                            {{ $active->draw($active) }}
                        </p>
                    @else
                        <p>Welcome back capt'n <b>{{ $user->name }}</b>. You currently have no active ship.
                    @endif

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">Your ships</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        @if ($user->myShips()->count() == 0)
                            <p class="text-center">You have no ships.</p>
                            <div class="text-center">
                                <a href="{{ route('ship_create_beginner') }}" class="btn btn-primary">Create a beginner ship</a>
                            </div>

                        @else
                            @foreach ($user->myShips() as $ship)
                                <li>
                                    <a href="{{ $ship->path() }}">{{ $ship->name }}</a>
                                    <span class="label label-success">{{ $ship->current_health }}/{{ $ship->maximum_health }}</span>,
                                    a {{ $ship->length }} footer with {{ $ship->decks }} decks and {{ $ship->crew()->count() }} sailors.
                                    <a class="label label-info">Make active</a>
                                </li>
                            @endforeach
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
