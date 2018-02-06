@extends('layouts.app')

@section('title', 'Dashboard')

@php
    $user = auth()->user();
    $active = $user->activeShip();
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">Captain {{ $user->name }}'s quarters</div>
                    <div class="panel-body text-center">
                        @svg('captain', 'icon-xxl')
                        @if ($active != null)
                            <p>Welcome back captain <b>{{ $user->name }}</b>.</p>
                            <p>
                                You're currently on the
                                <a href="{{ $active->path() }}"><b>{{ $active->name }}</b></a>, and
                                its {{ $active->current_sailors }} sailors are ready for your command.
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
                        @include('ships.draw', ['ship' => $active])
                    </div>
                </div>
                @endif
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">Your stats</div>
                    <div class="panel-body">
                        @include('user.stats')
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Your ships <span class="pull-right">{{ $user->myShips()->count() }}
                            / {{ $user->max_ships }}</span></div>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($user->myShips()->count() == 0)
                            <p class="text-center">You have no ships.</p>
                            <div class="text-center">
                                <a href="{{ route('ship_create_beginner') }}" class="btn btn-primary">Create a free beginner ship</a>
                            </div>
                        @else
                            <p class="text-center">
                                <a href="{{ route('ship_create') }}" class="btn btn-primary">Buy a new ship</a>
                            </p>
                            @if ($active != null)
                                @php $ship = auth()->user()->activeShip(); @endphp
                                @include('ships.list')
                            @endif
                            @foreach ($user->myShips() as $ship)
                                @php
                                    // do not show the currently active ship
                                    if ($active != null) {
                                        if ($ship->id == $active->id) continue;
                                    }
                                @endphp
                                @include('ships.list')
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
