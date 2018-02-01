@extends('layouts.app')

@section('title', 'Yarr, we are currently experiencing some heavy weather! (server error)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <p>@svg('ship-in-storm', 'icon-xxxl')</p>
                        <p>We are currently experiencing some difficulties serving you this page, please bear with us!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection