@extends('layouts.app')

@section('title', 'Combat')

@php
    $ship = $user->activeShip();
    $enemy = $ship;
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="ra ra-ocean-emblem"></i> You
                    </div>
                    <div class="panel-body text-center">
                        {{ $ship->draw($ship) }}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Enemy
                    </div>
                    <div class="panel-body text-center">
                        {{ $enemy->draw($enemy) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection