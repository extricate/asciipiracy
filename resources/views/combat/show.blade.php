@extends('combat.index')

@php
    $ship = $user->activeShip();
@endphp

@section('fight_title')
    Combat log of the fight with {{ $enemy->name }}
@endsection

@section('commands')
    @include('combat.partials.commands')
@endsection

@section('user_ship')
    <p>
        @include('ships.stats')
    </p>
    @include('ships.draw')
@endsection

@section('enemy_ship')
    <p>
        @include('ships.stats--enemy')
    </p>
    @include('ships.draw-enemy')
@endsection