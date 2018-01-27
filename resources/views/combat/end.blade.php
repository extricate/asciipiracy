@extends('layouts.app')

@section('title', 'Combat end')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @yield('combat_status')
                    </div>
                    <div class="panel-body text-center">
                        @if (session()->has('message'))
                            {{ session('message') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection