@php $user = Auth::user(); $city = $user->isIn(); $active = $user->activeShip(); @endphp

@extends('layouts.app')

@section('title', 'Shipwright')
@section('store_name', Auth::user()->isIn()->shipwright_name)
@section('store_type', 'Shipwright')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        The @yield('store_name') @yield('store_type')
                    </div>
                    <div class="panel-body">
                        <div class="col-lg-4 col-lg-offset-4">
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        The shopkeeper
                                    </div>
                                    <div class="panel-body">
                                        @if (session()->has('trade'))
                                            <div class="alert alert-success">
                                                {!! session('trade') !!}
                                            </div>
                                        @elseif (session()->has('error'))
                                            <div class="alert alert-danger">
                                                {!! session('error') !!}
                                            </div>
                                        @else
                                            Welcome to the @yield('store_name') @yield('store_type'). We offer all sorts
                                            of services for
                                            your ships.
                                        @endif
                                    </div>
                                </div>
                                @include('settlement.stores.shipwright.services')
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Ships available for purchase
                                    </div>
                                    <div class="panel-body">
                                        <a href="{{ route('ship_store') }}" class="btn btn-primary">View available
                                            ships</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                @include('settlement.stores.shipwright.upgrades')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                @if ($user->myShips()->count() == 0)
                    <div class="text-center">
                        <a href="{{ route('ship_create_beginner') }}" class="btn btn-primary">Create a free beginner
                            ship</a>
                    </div>
                @endif
                @if ($active != null)
                    @php $ship = auth()->user()->activeShip(); @endphp
                    @include('ships.list')
                @endif
                @foreach ($user->myShips() as $ship)
                    @php
                        // do not show the currently active ship
                        if ($active != null) {
                            if ($ship->id == $active->id) continue;
                        }
                    @endphp
                    @include('ships.list')
                @endforeach
            </div>
        </div>
    </div>
@endsection