@extends('combat.index')

@php
    $ship = $user->activeShip();
@endphp

@section('commands')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Your orders, commander {{ $user->name }}?
                </div>
                <div class="panel-body text-center">
                    <div class="col-md-4">
                        {{ Form::open(['method' => 'POST', 'class' => 'form-inline', 'route' => ['combat_attack', $ship, $enemy->id]]) }}
                        {{ Form::submit('Fight!', ['class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    </div>

                    <div class="col-md-4">
                        {{ Form::open(['method' => 'POST', 'class' => 'form-inline', 'route' => ['combat_escape', $ship->id]]) }}
                        {{ Form::submit('Escape', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                    </div>

                    <div class="col-md-4">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm_delete">
                            Surrender
                        </button>
                        @include('modal.show')
                    </div>
                </div>
            </div>
        </div>
    </div>
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