@extends('layouts.app')

@section('title', 'Combat end')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="ra ra-trophy"></i>
                    </div>
                    <div class="panel-body text-center">
                        @yield('user_ship')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection