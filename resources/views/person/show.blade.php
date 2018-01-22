@extends('layouts.app')

@section('title', $person->name)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">{{ $person->id }}</a>
                        {{ $person->name }}
                    </div>

                    <div class="panel-body">
                        <div class="body">
                            <h2>Attributes</h2>

                            <h3>Random characteristics</h3>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    <div class="panel-body">
                        <p class="text-center">
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            </div>
        </div>

        @auth
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                </div>
            </div>
        @endauth
    </div>
@endsection
