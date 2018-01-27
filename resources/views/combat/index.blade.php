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
                        @if (!empty($error))
                            <div class="alert alert-warning">
                                {{ $error }}
                            </div>
                        @endif
                        @yield('combat.log')
                    </div>
                </div>
            </div>
        </div>
        @yield('commands');
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