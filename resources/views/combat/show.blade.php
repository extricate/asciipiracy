@extends('combat.index')

@php
    $ship = $user->activeShip();
@endphp

@section('commands')
    @include('combat.partials.commands')
@endsection

@section('user_ship')
    <div class="panel panel-default">
        <div class="panel-body">
            <i class="ra ra-hearts ra-fw"></i> Health: {{ $ship->current_health }}/{{ $ship->maximum_health }}
            <i class="ra ra-crossed-sabres ra-fw"></i> Attack: {{ $ship->attackStatistics($ship) }}
            <i class="ra ra-cog ra-fw"></i> Escape: {{ $ship->escapeStatistics($ship) }}
            <i class="fa fa-users fa-fw"></i> Crew {{ $ship->crew->count() }}/{{ $ship->max_sailors }}
        </div>
    </div>
    {{ $ship->draw($ship) }}
@endsection

@section('enemy_ship')
    <div class="panel panel-default">
        <div class="panel-body">
            <i class="ra ra-hearts ra-fw"></i> Health: {{ $enemy->current_health }}/{{ $enemy->maximum_health }}
            <i class="ra ra-crossed-sabres ra-fw"></i> Attack: {{ $enemy->attackStatistics($enemy) }}
            <i class="ra ra-cog ra-fw"></i> Escape: {{ $enemy->escapeStatistics($enemy) }}
            <i class="fa fa-users fa-fw"></i> Crew {{ $enemy->crew->count() }}/{{ $enemy->max_sailors }}
        </div>
    </div>
    {{ $enemy->draw($enemy) }}
@endsection