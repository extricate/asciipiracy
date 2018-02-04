@php $user = Auth::user(); $city = $user->isIn(); $ship = $user->activeShip(); @endphp

@extends('settlement.stores.index')

@section('title', 'General Store')
@section('store_name', Auth::user()->isIn()->general_store_name)
@section('store_type', 'General Store')

@section('store_intro')
    Welcome to the @yield('store_name') @yield('store_type'). Here you can purchase everything a
    captain might need on his journey. What can I interest you in today?
@endsection

@section('store_contents')
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Supplies
                </div>
                <div class="panel-body">
                    {{ Form::open(['method' => 'POST', 'route' => ['buy_goods'], 'class'=>'form-inline']) }}
                    <div class="form-group">
                        <label class="sr-only" for="goods">Amount of goods</label>
                        <div class="input-group">
                            <div class="input-group-addon">@svg('chicken', 'icon-sm')</div>
                            <input type="number" name="goods" class="form-control input-supplies" id="goods"
                                   placeholder="Amount of goods" value="{!! old('goods') !!}">
                            {{ Form::submit('Buy for 5 each', ['class' => 'btn btn-primary input-group-addon btn-trade']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Trade goods
                </div>
                @include('settlement.stores.general.trade')
            </div>
        </div>
    </div>
@endsection