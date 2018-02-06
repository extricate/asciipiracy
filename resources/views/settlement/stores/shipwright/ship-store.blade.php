@php $user = Auth::user(); $city = $user->isIn(); $ship = $user->activeShip(); @endphp

@extends('layouts.app')

@section('title', 'Ship store - Shipwright')
@section('store_name', Auth::user()->isIn()->shipwright_name)
@section('store_type', 'Shipwright')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        The @yield('store_name') @yield('store_type')
                    </div>
                    <div class="panel-body">
                        <p>The shipwright takes you to the mooring, where there are three ships moored.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $sale->get(0)->class }} {{ $sale->get(0)->name }}
                    </div>
                    <div class="panel-body">
                        @include('ships.draw', ['ship' => $sale->get(0)])
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $sale->get(1)->class }} {{ $sale->get(1)->name }}
                    </div>
                    <div class="panel-body">
                        @include('ships.draw', ['ship' => $sale->get(1)])
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $sale->get(2)->class }} {{ $sale->get(2)->name }}
                    </div>
                    <div class="panel-body">
                        @include('ships.draw', ['ship' => $sale->get(2)])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection