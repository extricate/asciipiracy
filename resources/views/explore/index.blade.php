@extends('layouts.app')

@section('title', 'Upgrade ship')

@php
    $user = auth()->user();
    $active = $user->activeShip();
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-map-o"></i> Exploration
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
                    <div class="panel-body">
                        <a href="{{ route('explore_now') }}" class="btn btn-primary">Go explore</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection