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

                        <div class="settlement">
                            <div class="settlement-icon settlement-primary">@svg('village', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-1">@svg('mansion', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-4">@svg('palm-tree', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-2">@svg('fort', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-3">@svg('village', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-5">@svg('palm-tree', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-6">@svg('palm-tree-inverse', 'icon-xxxl')</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Governors district
                    </div>
                    <div class="panel-body">
                        <p class="text-center">@svg('mansion', 'icon-xxxl')</p>
                        <p>Visit the governor</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Merchants' district
                    </div>
                    <div class="panel-body">
                        <p class="text-center">@svg('stall', 'icon-xxxl')</p>
                        <p>Need some goods? Got something to sell? This is the place to be!</p>
                        <a href="{{ route('general_store') }}" class="btn btn-default">Visit the general store</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Crafting district
                    </div>
                    <div class="panel-body">
                        <p class="text-center">@svg('tools', 'icon-xxxl')</p>
                        <p>Need a new ship? Require some upgrades? This is the place to be.</p>
                        <a href="{{ route('shipwright') }}" class="btn btn-default">Visit the shipwright</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Visit the tavern
                    </div>
                    <div class="panel-body">
                        <p class="text-center">@svg('bar', 'icon-xxxl')</p>
                        <p>Need to hire some sailors? Want to hear the latest gossip? This is the place to be.</p>
                        <a href="{{ route('tavern') }}" class="btn btn-default">Visit the tavern</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection