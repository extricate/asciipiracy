@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">A list of all ships</div>

                    <div class="panel-body">
                        @foreach ($ships as $ship)
                            <article>
                                <h4>
                                    <a href="/ships/{{ $ship->id  }}">
                                        {{ $ship->name }}
                                    </a>
                                </h4>
                            </article>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
