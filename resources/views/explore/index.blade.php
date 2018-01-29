@extends('layouts.app')

@section('title', 'Upgrade ship')

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
                        <p>
                            <a href="{{ route('explore_now') }}" class="btn btn-primary btn-lg">Go explore</a>
                        </p>
                    </div>
                    @if ($ship != null)
                        <div class="panel-footer text-center">
                            <div class="label label-info">
                                Exploration with your current ship costs {{ $ship->explorationCost() }} goods.
                            </div>
                            <br>
                            <div class="label label-info">
                                That's @php echo round($user->goods/$ship->explorationCost(), 0) @endphp more journeys
                                with
                                the goods left.
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
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"
                                     style="enable-background:new 0 0 512 512;" xml:space="preserve" width="20px"
                                     height="20px">
                                    <g>
                                        <g>
                                            @include('icons.ship')
                                        </g>
                                    </g>
                                </svg>
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
@endsection