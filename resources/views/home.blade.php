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
                    <div class="panel-body text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"
                             style="enable-background:new 0 0 512 512;" xml:space="preserve" width="100px"
                             height="100px">
                                        <g>
                                            <g>
                                                @include('icons.captain')
                                            </g>
                                        </g>
                                    </svg>
                        @if ($active != null)
                            <p>Welcome back capt'n <b>{{ $user->name }}</b>.</p>
                            <p>
                                You're currently on the
                                <a href="{{ $active->path() }}"><b>{{ $active->name }}</b></a>, and
                                its {{ $active->crew->count() }} sailors are ready for your command.
                            </p>
                        @else
                            <p>Welcome back captain <b>{{ $user->name }}</b>. You currently have no active ship.
                        @endif
                    </div>
                </div>
                @if ($active != null)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            The {{ $active->name }}
                        </div>
                        <div class="panel-body">
                            {{ $active->draw($active) }}
                        </div>
                    </div>
                @endif
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
                            @foreach ($user->myShips() as $ship)
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <a href="{{ $ship->path() }}">{{ $ship->name }}</a>
                                        a {{ $ship->length }} footer with {{ $ship->decks }} decks
                                        and {{ $ship->crew()->count() }} sailors.

                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                @include('ships.stats')
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                @if ($ship->id == $user->active_ship)
                                                    {{ Form::open(['method' => 'PUT', 'route' => ['set_active_ship', 0]]) }}
                                                    {{ Form::submit('Active ship', ['class' => 'btn btn-sm btn-primary']) }}
                                                    {{ Form::close() }}
                                                @else
                                                    {{ Form::open(['method' => 'PUT', 'route' => ['set_active_ship', $ship->id]]) }}
                                                    {{ Form::submit('Make active', ['class' => 'btn btn-sm btn-info']) }}
                                                    {{ Form::close() }}
                                                @endif
                                            </div>
                                            <div class="col-md-8 text-right">
                                                <a class="btn btn-default btn-sm">Repair</a>
                                                <a class="btn btn-default btn-sm">Upgrade</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
