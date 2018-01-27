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
                    <div class="panel-heading">Captain {{ $user->name }}'s quarters</div>
                    <div class="panel-body">
                        @if ($active != null)
                            <p>Welcome back capt'n <b>{{ $user->name }}</b>.
                                You're currently on the
                                <a href="{{ $active->path() }}"><b>{{ $active->name }}</b></a>, and
                                its {{ $active->crew->count() }} sailors are ready for your command.
                            </p>
                            <p class="text-center">
                                {{ $active->draw($active) }}
                            </p>
                        @else
                            <p>Welcome back captain <b>{{ $user->name }}</b>. You currently have no active ship.
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
                                <a href="{{ route('ship_create_beginner') }}" class="btn btn-primary">Create a free
                                    beginner ship</a>
                            </div>

                        @else
                            <p class="text-center">
                                <a href="{{ route('ship_create') }}" class="btn btn-primary">Buy a new ship</a>
                            </p>
                            <p>
                                The ships are generated randomly and cost 1000 gold.
                            </p>
                            <ul>
                                @foreach ($user->myShips() as $ship)
                                    <li>
                                        <a href="{{ $ship->path() }}">{{ $ship->name }}</a>
                                        <span class="label label-success">{{ $ship->current_health }}
                                            /{{ $ship->maximum_health }}</span>,
                                        a {{ $ship->length }} footer with {{ $ship->decks }} decks
                                        and {{ $ship->crew()->count() }} sailors.

                                        @if ($ship->id == $user->active_ship)
                                            {{ Form::open(['method' => 'PUT', 'route' => ['set_active_ship', 0]]) }}
                                            {{ Form::submit('Active ship', ['class' => 'btn btn-sm btn-primary']) }}
                                            {{ Form::close() }}
                                        @else
                                            {{ Form::open(['method' => 'PUT', 'route' => ['set_active_ship', $ship->id]]) }}
                                            {{ Form::submit('Make active', ['class' => 'btn btn-sm btn-info']) }}
                                            {{ Form::close() }}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
