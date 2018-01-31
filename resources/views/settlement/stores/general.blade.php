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
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Supplies
                </div>
                <div class="panel-body">
                    {{ Form::open(['method' => 'POST', 'route' => ['buy_goods'], 'class'=>'form-inline']) }}
                    <div class="form-group">
                        <label class="sr-only" for="goods">Amount of goods</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="ra ra-chicken-leg"></i></div>
                            <input type="number" name="goods" class="form-control" id="goods" placeholder="Amount of goods" value="{!! old('goods') !!}">
                        </div>
                    </div>
                    {{ Form::submit('Buy goods', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Trader goods
                </div>
                <div class="panel-body">
                    @include('settlement.stores.general.trade')
                </div>
            </div>
        </div>
    </div>
@endsection