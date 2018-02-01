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
                <li>
                    <a href="{{ route('explore') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"
                             style="enable-background:new 0 0 512 512;" xml:space="preserve" width="14px"
                             height="14px">
                                        <g>
                                            <g>
                                                @include('icons.ship')
                                            </g>
                                        </g>
                                    </svg>
                        Explore
                    </a>
                </li>
                <li>
                    <a href="{{ route('start_combat') }}"><span class="ra ra-crossed-sabres"></span> Fight
                        pirates</a>
                </li>
                <li>
                    <a href="{{ route('visit_town') }}"><span class="fa fa-home"></span> Town</a>
                </li>
                <li>
                    <a href=""><span class="fa fa-map-o"></span> Travel</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li><a href="#"><i class="ra ra-gold-bar"></i> {{ Auth::user()->gold }}</a></li>
                        <li><a href="#"><i class="ra ra-chicken-leg"></i> {{ Auth::user()->goods }}</a></li>

                        @php $user = Auth::user(); $active = $user->activeShip(); @endphp
                        <li class="dropdown">
                            <a class="dropdown-toggle" type="button" id="ship-menu" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"
                                     style="enable-background:new 0 0 512 512;" xml:space="preserve" width="14px"
                                     height="14px">
                                        <g>
                                            <g>
                                                @include('icons.ship')
                                            </g>
                                        </g>
                                    </svg>
                                @if ($user->activeShip() !== null)
                                    <span class="label label-{{ Auth::user()->activeShip()->health(Auth::user()->activeShip()) }}"><i
                                                class="fa fa-heart"></i> {{ Auth::user()->activeShip()->current_health }}
                                        /{{ Auth::user()->activeShip()->maximum_health }}</span>
                                @else
                                    <span class="label label-default"><i class="fa fa-heart"></i> --/-- </span>
                                @endif
                            </a>
                            <ul class="dropdown-menu ship-quicklist" aria-labelledby="ship-menu">
                                @if ($active != null)
                                    <li class="ship-quicklist-item">
                                        @php $ship = auth()->user()->activeShip(); @endphp
                                        @include('layouts.header.ship-quicklist')
                                    </li>
                                @endif
                                @foreach ($user->myShips() as $ship)
                                    @php
                                        // do not show the currently active ship
                                        if ($active != null) {
                                            if ($ship->id == $active->id) continue;
                                        }
                                    @endphp
                                    <li class="ship-quicklist-item">
                                        @include('layouts.header.ship-quicklist')
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true">
                                Lvl {{ $user->level }} captain {{ Auth::user()->name }}
                                <progress class="experience-bar" max="100"
                                          value="{{ $user->levelProgress($user) }}">

                                </progress>
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