@extends('layouts.app')

@section('title', 'Overview of ships')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">A list of all ships</div>

                    <div class="panel-body">
                        @foreach ($ships as $ship)
                            <article>
                                <h4>
                                    <a href="{{ $ship->path() }}">
                                        {{ $ship->name }}
                                    </a>
                                    <i>captained by</i>
                                    <a href="{{ $ship->owner->path() }}">
                                        {{ $ship->owner->name }}
                                    </a>

                                    <div class="small text-right">
                                        She's a {{ $ship->length }} footer with {{ $ship->decks }} decks and {{ $ship->crew->count() }} sailors.
                                    </div>

                                    <span class="label label-danger">
                                        {{ $ship->attackStatistics($ship) }} attack
                                    </span>
                                    <span class="label label-info">
                                        {{ $ship->escapeStatistics($ship) }} escape
                                    </span>
                                    <span class="label label-default">
                                        {{ $ship->max_speed }} knots
                                    </span>
                                    <span class="label label-primary">
                                        {{ $ship->total_hold }} hold
                                    </span>
                                </h4>
                            </article>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
