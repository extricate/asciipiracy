@extends('layouts.app')

@section('title', 'Combat')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @yield('commands')
            </div>
        </div>

        @if (session()->has('attack'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times"></i></span>
                        </button>
                        {!! session('attack') !!}
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        You: {{ $ship->class }} {{ $ship->name }}
                    </div>
                    <div class="panel-body text-center">
                        @yield('user_ship')
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Enemy: {{ $enemy->class }} {{ $enemy->name }}
                    </div>
                    <div class="panel-body text-center">
                        @yield('enemy_ship')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection