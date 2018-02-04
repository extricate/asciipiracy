@extends('layouts.app')

@section('title', $settlement->type . ' ' . $settlement->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading settlement-heading">
                        {{ $settlement->type }} "{{ $settlement->name }}"
                    </div>


                    @if ($settlement->type == 'Monastery')

                        <div class="settlement">
                            <div class="settlement-icon settlement-floor"></div>
                            <div class="settlement-icon settlement-sky"></div>
                            <div class="settlement-icon settlement-primary settlement-centered">@svg('church',
                                'icon-xxxl')
                            </div>
                            <div class="settlement-icon settlement-icon-4">@svg('palm-tree', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-7">@svg('palm-tree-inverse', 'icon-xxxl')</div>
                        </div>

                    @elseif ($settlement->type == 'Haven')
                        <div class="settlement">
                            <div class="settlement-icon settlement-floor"></div>
                            <div class="settlement-icon settlement-sky"></div>
                            <div class="settlement-icon settlement-icon-4">@svg('palm-island', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-3">@svg('hut', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-5">@svg('palm-island', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-bottom-left">@svg('bonfire', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-6">@svg('palm-tree-inverse', 'icon-xxxl')</div>
                        </div>
                    @elseif ($settlement->type == 'Outpost')
                        <div class="settlement">
                            <div class="settlement-icon settlement-floor"></div>
                            <div class="settlement-icon settlement-sky"></div>
                            <div class="settlement-icon settlement-icon-4">@svg('palm-island', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-3">@svg('village', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-bottom-right">@svg('well-sm', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-bottom-left">@svg('bonfire', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-6">@svg('palm-tree-inverse', 'icon-xxxl')</div>
                        </div>

                    @elseif ($settlement->type == 'Village')
                        <div class="settlement">
                            <div class="settlement-icon settlement-floor"></div>
                            <div class="settlement-icon settlement-sky"></div>
                            <div class="settlement-icon settlement-icon-6">@svg('village', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-4">@svg('palm-island', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-3">@svg('village', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-top-right">@svg('village', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-top-right">@svg('palm-tree-inverse',
                                'icon-xxl')
                            </div>
                            <div class="settlement-icon settlement-icon-bottom-right">@svg('well-sm', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-bottom-left">@svg('bonfire', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-6">@svg('palm-tree', 'icon-xxxl')</div>
                        </div>
                    @elseif ($settlement->type == 'Town')
                        <div class="settlement">
                            <div class="settlement-icon settlement-floor"></div>
                            <div class="settlement-icon settlement-sky"></div>
                            <div class="settlement-icon settlement-icon-6">@svg('villa', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-top-left">@svg('palm-tree', 'icon-xl')</div>
                            <div class="settlement-icon settlement-icon-center-left">@svg('village', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-top-right">@svg('village', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-top-right">@svg('palm-tree-inverse',
                                'icon-xxl')
                            </div>
                            <div class="settlement-icon settlement-icon-6">@svg('palm-tree', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-3">@svg('villa', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-bottom-right">@svg('well', 'icon-xxl')</div>
                        </div>

                    @elseif ($settlement->type == 'City')
                        <div class="settlement">
                            <div class="settlement-icon settlement-floor"></div>
                            <div class="settlement-icon settlement-sky"></div>
                            <div class="settlement-icon settlement-primary">@svg('villa-blue', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-top-center">@svg('mansion', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-4">@svg('palm-island', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-2">@svg('fort', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-top-right">@svg('villa', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-3">@svg('villa', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-bottom-right">@svg('well', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-5">@svg('palm-tree', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-6">@svg('palm-tree-inverse', 'icon-xxxl')</div>
                        </div>
                    @elseif ($settlement->type == 'Metropolis')
                        <div class="settlement">
                            <div class="settlement-icon settlement-floor"></div>
                            <div class="settlement-icon settlement-sky"></div>
                            <div class="settlement-icon settlement-icon-top-left">@svg('villa', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-6">@svg('village', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-top-center">@svg('mansion', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-4">@svg('palm-island', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-center-left">@svg('fort', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-top-right">@svg('fort', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-3">@svg('villa', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-bottom-right">@svg('well', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-5">@svg('palm-tree', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-bottom-center">@svg('palm-tree-inverse',
                                'icon-xxxl')
                            </div>
                        </div>
                    @elseif ($settlement->type == 'Capital')
                        <div class="settlement">
                            <div class="settlement-icon settlement-floor"></div>
                            <div class="settlement-icon settlement-sky"></div>
                            <div class="settlement-icon settlement-icon-top-left">@svg('villa', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-6">@svg('village', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-top-center">@svg('mansion', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-4">@svg('palm-island', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-center-left">@svg('fort', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-top-right">@svg('fort', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-3">@svg('villa', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-bottom-right">@svg('well', 'icon-xxl')</div>
                            <div class="settlement-icon settlement-icon-5">@svg('palm-tree', 'icon-xxxl')</div>
                            <div class="settlement-icon settlement-icon-bottom-center">@svg('palm-tree-inverse',
                                'icon-xxxl')
                            </div>
                        </div>
                    @endif
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