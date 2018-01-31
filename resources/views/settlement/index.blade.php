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
                        <i class="ra ra-capitol"></i> Governors district
                    </div>
                    <div class="panel-body">
                        Visit the officers district
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="ra ra-gold-bar"></i> Merchants' district
                    </div>
                    <div class="panel-body">
                        <p>Need some goods? Got something to sell? This is the place to be!</p>
                        <a href="{{ route('general_store') }}" class="btn btn-default">Visit the general store</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="ra ra-hammer"></i> Crafting district
                    </div>
                    <div class="panel-body">
                        <p>Need a new ship? Require some upgrades? This is the place to be.</p>
                        <a href="{{ route('shipwright') }}" class="btn btn-default">Visit the shipwright</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="ra ra-beer"></i> Visit the tavern
                    </div>
                    <div class="panel-body">
                        <p>Need to hire some sailors? Want to hear the latest gossip? This is the place to be.</p>
                        <a href="{{ route('tavern') }}" class="btn btn-default">Visit the tavern</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection