<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - ASCIIPiracy</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/img/anchor.png') }}">
</head>
<body>
<div id="app">
    @include('layouts.header.nav')

    @if (session()->has('message'))
        <noscript>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true"><i class="fa fa-times"></i></span>
                            </button>
                            {!! session('message') !!}
                        </div>
                    </div>
                </div>
            </div>
        </noscript>
    @endif
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@if (session()->has('message'))
    <script>
        $.notifyDefaults({
            type: 'info',
            mouse_over: 'pause',
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            }
        });
        $.notify({
            message: '{!! session('message') !!}',
            type: 'info',
            icon: 'fa fa-exclamation-triangle',
        });
    </script>
@endif
@if (session()->has('error'))
    <script>
        $.notifyDefaults({
            type: 'danger',
            mouse_over: 'pause',
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            }
        });
        $.notify({
            message: '{!! session('error') !!}',
            type: 'danger',
            icon: 'fa fa-exclamation-triangle',
        });
    </script>
@endif
</body>
</html>
