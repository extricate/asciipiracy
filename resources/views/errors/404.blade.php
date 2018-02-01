@extends('layouts.app')

@section('title', 'Arr, that page appears to be lost! (404 error)')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <p>@svg('ship-in-storm', 'icon-xxxl')</p>
                        <p>The page you are looking for was lost in a terrible storm.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection