@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Here is a list of your ships:</h2>
                        @php
                            $user = auth()->user()
                        @endphp
                        @if ($user->myShips()->count() == 0)
                            You have no ships.
                        @else
                            @foreach ($user->myShips() as $ship)
                                <li>
                                    <a href="{{ $ship->path() }}">{{ $ship->name }}</a>, a {{ $ship->length }} footer with {{ $ship->decks }} decks and {{ $ship->crew()->count() }} sailors.
                                </li>
                            @endforeach
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
