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
                        @svg('rudder', 'icon-nav')
                        Explore
                    </a>
                </li>
                <li>
                    <a href="{{ route('start_combat') }}">@svg('sword', 'icon-nav') Fight
                        pirates</a>
                </li>
                <li>
                    <a href="{{ route('visit_town') }}">@svg('cabin', 'icon-nav') Town</a>
                </li>
                <li>
                    <a href="">@svg('map', 'icon-nav') Travel</a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                    @else
                        <li>
                            <a href="#">
                                @svg('coins', 'icon-nav') {{ Auth::user()->gold }}
                                @svg('chicken', 'icon-nav') {{ Auth::user()->goods }}
                            </a>
                        </li>

                        @php $user = Auth::user(); $active = $user->activeShip(); @endphp
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" type="button" id="ship-menu" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                @if ($user->activeShip() !== null)
                                    <label class="label-ship label-{{ Auth::user()->activeShip()->health(Auth::user()->activeShip()) }}">
                                        @svg('ship', 'icon-nav')
                                        {{ Auth::user()->activeShip()->current_health }}
                                        /{{ Auth::user()->activeShip()->maximum_health }}
                                    </label>
                                @else
                                    <label class="label-no-ship">
                                        @svg('ship', 'icon-nav') --/-- </label>
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