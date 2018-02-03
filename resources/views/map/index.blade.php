@extends('layouts.app')

@section('title', 'Travel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <p>
                        {{ Form::open(['method' => 'POST', 'route' => ['travel'], 'class'=>'form-inline trade-form trade-form-gemstones']) }}
                        {{ Form::hidden('x', '10') }}
                        {{ Form::hidden('y', '10') }}
                        {{ Form::submit('Create small map', ['class' => 'btn btn-primary']) }}
                        {{ Form::close() }}
                        </p>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                @yield('map')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection