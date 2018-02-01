@extends('layouts.app')

@section('title', 'Exploration')

@php
    $user = auth()->user();
    $ship = auth()->user()->activeShip();
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="ra ra-ocean-emblem"></i> Exploration
                    </div>
                    <div class="panel-body text-center">
                        @yield('exploration')
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Actions
                    </div>
                    <div class="panel-body text-center">
                        @if ($ship != null)
                            @if ($ship->current_health >= ($ship->maximum_health / 2))
                                <p>
                                    <a href="{{ route('explore_now') }}" class="btn btn-primary btn-lg">Go explore</a>
                                </p>
                            @else
                                <p>
                                    <button type="button" data-toggle="modal" data-target="#lowhealth" class="btn btn-primary btn-lg">Go explore</button>
                                </p>
                            @endif
                        @endif
                    </div>
                    @if ($ship != null)
                        <div class="panel-footer text-center">
                            <div class="label label-info">
                                Exploration with your current ship costs {{ $ship->explorationCost() }} goods.
                            </div>
                            <br>
                            <div class="label label-info">
                                That's @php echo round($user->goods/$ship->explorationCost(), 0) @endphp more journeys with the goods left.
                            </div>
                        </div>
                    @endif
                </div>
                @if ($ship != null)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            The <a href="{{ $ship->path() }}">{{ $ship->name }}</a>
                            @if ($ship->is_beginner_ship == true)
                                - beginner
                            @endif
                            <span class="pull-right">
                                @svg('ship', 'icon-sm')
                            </span>
                        </div>
                        <div class="panel-body">
                            <p>
                                This is the ship you are currently on.
                            </p>
                        </div>
                        <div class="panel-footer text-center">
                            @include('ships.stats')
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="lowhealth" aria-labelledby="low health confirmation">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close"><span aria-hidden="true">&times;</span>
                    </button>
                    Are you sure about that?
                </div>
                <div class="modal-body">
                    <p>Your ship is low on health, are you sure you want to do this?</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('explore_now') }}">Continue</a>
                </div>
            </div>
        </div>
    </div>
@endsection