@extends('layouts.app')

@section('title', 'Overview of ships')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">A list of all people</div>

                    <div class="panel-body">
                        @foreach ($user as $player)
                            <article>
                                <h4>
                                    <a href="{{ $player->path() }}">
                                        {{ $player->name }}
                                    </a>
                                    <div class="text-right">
                                    </div>
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
