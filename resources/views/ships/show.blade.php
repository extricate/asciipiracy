@extends('layouts.app')

@section('title', $ship->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="{{ $ship->path() }}">#{{ $ship->id }}</a>
                        {{ $ship->name }}, owned by player {{ $ship->owner->name }}
                    </div>

                    <div class="panel-body">
                        <div class="body">
                            <h2>Ship attributes</h2>
                            <p>
                                The ship has <b>{{ $ship->decks }}</b> deck(s) and <b>{{ $ship->masts }}</b> mast(s),
                                bearing a total amount of <b>{{ $ship->propulsion }} m²</b> of sails. The ships' length
                                is <b>{{ $ship->length }} feet</b>, bearing a draught of <b>{{ $ship->draught }}
                                    feet</b> and a beam of <b>{{ $ship->beam }} feet</b>.
                            </p>

                            <h3>Combat characteristics: </h3>
                            <p>
                                <ul>
                                    <li>Cannons: {{ $ship->cannons }}, bearing {{ $ship->cannon_caliber }} shot</li>
                                    <li>Gunports: {{ $ship->gunports }}</li>
                                    <li>Minimum sailors: {{ $ship->min_sailors }}</li>
                                    <li>Current sailors: {{ $ship->crew->count() }}</li>
                                    <li>Maximum sailors: {{ $ship->max_sailors }}</li>
                                </ul>

                                <h3>Trade characteristics: </h3>
                                <ul>
                                    <li>Total hold: {{ $ship->total_hold }} pound.</li>
                                </ul>

                                <h3>Random characteristics</h3>
                                <ul>
                                    <li>Construction date: {{ $ship->constructed_at }}</li>
                                    <li>Story: {{ $ship->story }}</li>
                                </ul>
                            </p>

                            <h3>Crew</h3>
                            <p>
                                @foreach ($ship->crew as $crewmember)
                                    <a href="{{ $crewmember->path() }}">{{ $crewmember->name }}</a>
                                @endforeach
                            </p>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        This is what the ship looks like
                    </div>
                    <div class="panel-body">
                        <p class="text-center">
                            {{ $ship->draw($ship) }}
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
