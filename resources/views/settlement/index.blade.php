@extends('layouts.app')

@section('title', $settlement->type . ' ' . $settlement->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        You are currently in the {{ $settlement->type }} "{{ $settlement->name }}"
                    </div>
                    <div class="panel-body">
                        What would you like to do?
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Officers district
                    </div>
                    <div class="panel-body">
                        Visit the officers district
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Merchants' district
                    </div>
                    <div class="panel-body">
                        Need some goods? Got something to sell? This is the place to be!
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Crafting district
                    </div>
                    <div class="panel-body">
                        Need a new ship? Require some upgrades? This is the place to be.
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Visit the tavern
                    </div>
                    <div class="panel-body">
                        Need to hire some sailors? Want to hear the latest gossip? This is the place to be.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection