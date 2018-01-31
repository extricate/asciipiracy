@extends('settlement.stores.index')

@section('title', 'Shipwright')
@section('store_name', 'Fogbank Hulls')
@section('store_type', 'Shipwright')

@section('store_intro')
    Welcome to the @yield('store_name') @yield('store_type'). We offer all sorts of services for your ships.
@endsection

@section('store_contents')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Shipwright services
                </div>
                <div class="panel-body">
                    {{ Form::open(['method' => 'POST', 'route' => ['buy_cannons'], 'class'=>'form-inline']) }}
                    <div class="form-group">
                        <label class="sr-only" for="goods">Amount of cannons</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="ra ra-cannon-shot"></i></div>
                            <input type="number" name="cannons" class="form-control" id="goods" placeholder="Amount of cannons" value="{!! old('cannons') !!}">
                        </div>
                    </div>
                    {{ Form::submit('Buy cannons', ['class' => 'btn btn-primary']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Ship upgrades
                </div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
@endsection