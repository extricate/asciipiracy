@extends('layouts.app')

@section('title', 'Upgrade ship')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Upgrade your ships</div>

                    <div class="panel-body">
                        @php
                            $user = auth()->user()
                        @endphp
                        @if ($user->myShips()->count() == 0)
                            You have no ships.
                        @else
                            @foreach ($user->myShips() as $ship)
                                <option>
                                    <a href="{{ $ship->path() }}">{{ $ship->name }}</a>, a {{ $ship->length }} footer with {{ $ship->decks }} decks and {{ $ship->crew()->count() }} sailors.
                                </option>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
