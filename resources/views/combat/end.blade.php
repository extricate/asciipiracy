@extends('layouts.app')

@section('title', 'Combat end')

@php
    $user = auth()->user();
@endphp

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        The fight is over...
                    </div>
                    <div class="panel-body text-center">
                        <p>
                            @if (session()->has('message'))
                                {{ session('message') }}
                            @else
                                @if ($user->is_in_combat == true)
                                    We're in the midst of a fight captain, get your act together!
                                @elseif ($user->combat_wins - $user->combat_losses > 0)
                                    A young sailor approaches you: "Sir, are you alright?". It appears you had been standing there for ten minutes, reliving moments of glory in the past. Ah, the good old days.
                                @else
                                    You roughly awake in your bed, covered in a cold sweat. The nightmares of your adventures still haunt you day to day... Perhaps it's time to quit this reckless captaining? You still have your life and limbs now... You decide to try to get some more sleep.
                                @endif
                            @endif

                            <a class="btn btn-primary" href="{{ route('home') }}">Onwards!</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection