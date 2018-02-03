@extends('layouts.app')

@section('title', 'Travel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <p>
                            {{ Form::open(['method' => 'POST', 'route' => ['travel'], 'class'=>'form-inline trade-form trade-form-gemstones']) }}
                            {{ Form::hidden('x', '5') }}
                            {{ Form::hidden('y', '5') }}
                            {{ Form::submit('Travel to a small region', ['class' => 'btn btn-primary']) }}
                            {{ Form::close() }}
                        </p>
                        <p>
                            Travelling cost goods equivalent to the total amount of crew on your ships combined.
                            You have <label class="label label-default">{{ $user->totalCrew() }} sailors</label> on your {{ $user->myShips()->count() }} @if ($user->myShips()->count() > 1) ships @else ship @endif.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-body">
                        @yield('map')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection