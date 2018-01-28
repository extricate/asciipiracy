<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ASCIIPiracy - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('explore') }}">Explore</a></li>
                    <li><a href="#">Town</a></li>
                    <li><a href="{{ route('ships') }}">Ships</a></li>
                    <li><a href="{{ route('people') }}">People</a></li>
                    <li><a href="{{ route('users') }}">Players</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li>
                                <a href="{{ route('home') }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"
                                         style="enable-background:new 0 0 512 512;" xml:space="preserve" width="14px"
                                         height="14px">
                                        <g>
                                            <g>
                                                <path d="M338.074,288.18l-33.461,39.293h-52.667V271h137.248l4.013-3.033c30.797-23.271,48.46-56.964,48.46-92.44    c-0.001-35.476-17.663-69.169-48.46-92.439l-4.013-3.032H251.946V17H140.384l11.392,41.95l-11.522,41.383h81.693v33.056h-98.306    l-4.013,3.032c-21.846,16.507-34.375,40.48-34.375,65.772c-0.001,25.292,12.528,49.267,34.375,65.774l4.013,3.033h98.306v56.473    H143.89v-29.47H0v88.94h67.055L97.929,495h277.115l31.728-84.604l61.288-51.074V318.18H512v-30H338.074z M221.946,251.768    l-10.237-7.736c-14.483-10.945-22.46-25.803-22.46-41.838c0-16.035,7.977-30.894,22.461-41.838l10.236-7.734V251.768z     M190,424.666h-30v-30h30V424.666z M251.946,97.574l12.505,9.449c23.566,17.808,36.545,42.136,36.546,68.504    c0,26.368-12.979,50.697-36.545,68.505l-12.506,9.45V97.574z M254,424.666h-30v-30h30V424.666z M318,424.666h-30v-30h30V424.666z"
                                                      fill="#777777"/>
                                            </g>
                                        </g>
                                    </svg>


                                    @if ($user->activeShip() !== null)
                                        @php

                                        @endphp
                                        <span class="label label-{{ Auth::user()->activeShip()->health() }}">HP: {{ Auth::user()->activeShip()->current_health }}/{{ Auth::user()->activeShip()->maximum_health }}</span>
                                    @else
                                        <span class="label label-default">HP:--/--
                                    @endif
                                </a>
                            </li>
                            <li><a href="#"><i class="ra ra-gold-bar"></i> Gold: {{ Auth::user()->gold }}</a></li>
                            <li><a href="#"><i class="ra ra-chicken-leg"></i> Goods: {{ Auth::user()->goods }}</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="/home">
                                            Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                              style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
