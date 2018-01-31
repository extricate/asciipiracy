@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        The @yield('store_name') @yield('store_type')
                    </div>
                    <div class="panel-body">
                        <p>
                            @if (session()->has('trade'))
                                <div class="alert alert-success">
                                    {!! session('trade') !!}
                                </div>
                            @elseif (session()->has('error'))
                                <div class="alert alert-danger">
                                    {!! session('error') !!}
                                </div>
                            @else
                                @yield('store_intro')
                            @endif
                            </p>

                            @yield('store_contents')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection