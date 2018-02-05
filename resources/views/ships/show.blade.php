@extends('layouts.app')

@section('title', $ship->name)

@php
    $user = auth()->user();
    $active = $user->activeShip();
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ $ship->path() }}">#{{ $ship->id }}</a>
                        {{ $ship->class }} {{ $ship->name }}
                    </div>

                    <div class="panel-body">
                        <div class="body">
                            @if ($ship->owner->id == Auth::user()->id)
                                <a href="" class="btn btn-primary">
                                    Sail
                                </a>
                                <a href="{{ $ship->path() }}/upgrade" class="btn btn-primary">
                                    Upgrade
                                </a>

                                <p>
                                    @if ($ship->id == $user->active_ship)
                                        {{ Form::open(['method' => 'PUT', 'route' => ['set_active_ship', 0]]) }}
                                        {{ Form::submit('Active ship', ['class' => 'btn btn-primary']) }}
                                        {{ Form::close() }}
                                    @else
                                        {{ Form::open(['method' => 'PUT', 'route' => ['set_active_ship', $ship->id]]) }}
                                        {{ Form::submit('Make active', ['class' => 'btn btn-primary']) }}
                                        {{ Form::close() }}
                                    @endif
                                </p>

                                <p>
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['ship_destroy', $ship->id]]) }}
                                    {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                    {{ Form::close() }}
                                </p>

                            @elseif (Auth::check())
                                <a href="{{ $ship->path() }}/upgrade" class="btn btn-danger">
                                    Attack
                                </a>
                            @endif
                            <h2>Ship attributes</h2>
                            <p>
                                The ship has <b>{{ $ship->decks }}</b> deck(s) and <b>{{ $ship->masts }}</b> mast(s),
                                bearing a total amount of <b>{{ $ship->propulsion }} m²</b> of sails. The ships' length
                                is <b>{{ $ship->length }} feet</b>, bearing a draught of <b>{{ $ship->draught }}
                                    feet</b> and a beam of <b>{{ $ship->beam }} feet</b>.
                            </p>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Combat
                                        </div>
                                        <div class="panel-body">
                                            <ul class="list-unstyled">
                                                <li><i class="ra ra-hearts ra-fw"></i>
                                                    Health: {{ $ship->current_health }}
                                                    /{{ $ship->maximum_health }}</li>
                                                <li><i class="ra ra-crossed-sabres ra-fw"></i>
                                                    Attack: {{ $ship->attackStatistics($ship) }}</li>
                                                <ul>
                                                    <li>Cannons: {{ $ship->cannons }},
                                                        bearing {{ $ship->cannon_caliber }} shot
                                                    </li>
                                                    <li>Gunports: {{ $ship->gunports }}</li>
                                                    <li>Officers: {{ $ship->crew->count() }}</li>
                                                    <li>Minimum sailors: {{ $ship->min_sailors }}</li>
                                                    <li>Current sailors: {{ $ship->current_sailors }}</li>
                                                    <li>Maximum sailors: {{ $ship->max_sailors }}</li>
                                                </ul>
                                                <li><i class="ra ra-cog ra-fw"></i>
                                                    Escape: {{ $ship->escapeStatistics($ship) }}</li>
                                                <ul>
                                                    <li>Maneuverability: {{ $ship->maneuverability }}</li>
                                                    <li>Maximum speed: {{ $ship->max_speed }} knots</li>
                                                </ul>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Trade
                                        </div>
                                        <div class="panel-body">
                                            <ul class="list-unstyled">
                                                <li>Total hold: {{ $ship->total_hold }} pound.</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Random
                                        </div>
                                        <div class="panel-body">
                                            <ul class="list-unstyled">
                                                <li>Ship value: {{ $ship->ShipValue($ship) }} <i class="ra ra-gold-bar"></i></li>
                                                <li>Construction date: {{ $ship->constructed_at }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h3>Crew</h3>
                            <p>
                                @foreach ($ship->crew as $crewmember)
                                    <a href="{{ $crewmember->path() }}"
                                       class="label label-primary">{{ $crewmember->rank }} {{ $crewmember->name }}</a>
                                @endforeach
                            </p>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Top look
                    </div>
                    <div class="panel-body">
                        @include('ships.draw')
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
