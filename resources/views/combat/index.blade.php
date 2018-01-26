@extends('layouts.app')

@section('title', 'Combat')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Combat log
                    </div>
                    <div class="panel-body">
                        @yield('combat.log')
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Your orders, commander {{ $user->name }}?
                    </div>
                    <div class="panel-body text-center">
                        <div class="col-md-4">
                            {{ Form::open(['method' => 'GET', 'class' => 'form-inline', 'route' => ['combat_attack', $ship->id]]) }}
                            {{ Form::submit('Attack', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </div>

                        <div class="col-md-4">
                            {{ Form::open(['method' => 'GET', 'class' => 'form-inline', 'route' => ['combat_escape', $ship->id]]) }}
                            {{ Form::submit('Escape', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </div>

                        <div class="col-md-4">
                            {{ Form::open(['method' => 'DELETE', 'class' => 'form-inline', 'route' => ['ship_destroy', $ship->id]]) }}
                            {{ Form::submit('Surrender', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="ra ra-ocean-emblem"></i> You
                    </div>
                    <div class="panel-body text-center">
                        @yield('user_ship')
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Enemy
                    </div>
                    <div class="panel-body text-center">
                        @yield('enemy_ship')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection