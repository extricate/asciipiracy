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
                <li class="nav-styled nav-explore">
                    <a href="{{ route('explore') }}">
                        @svg('rudder', 'icon-nav')
                        Explore
                    </a>
                </li>
                <li class="nav-styled nav-combat">
                    <a href="{{ route('start_combat') }}">@svg('sword', 'icon-nav') Hunt
                        pirates</a>
                </li>
                <li class="nav-styled nav-town">
                    <a href="{{ route('visit_town') }}">@svg('cabin', 'icon-nav') Town</a>
                </li>
                <li class="nav-styled nav-travel">
                    <a href="{{ route('map') }}">@svg('map', 'icon-nav') Travel</a>
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
                            <a href="#" class="no-link">
                                <label>@svg('coins', 'icon-nav') {{ Auth::user()->gold }}</label>
                                <label>@svg('chicken', 'icon-nav') {{ Auth::user()->goods }}</label>
                            </a>
                        </li>

                        @php $user = Auth::user(); $active = $user->activeShip(); @endphp
                        <li class="dropdown ship-quicklist-button">
                            <a href="#" class="dropdown-toggle" type="button" id="ship-menu" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                @if ($user->activeShip() != null)
                                    <label class="label-ship label-{{ Auth::user()->activeShip()->health(Auth::user()->activeShip()) }}">
                                        @svg('ship', 'icon-nav')
                                        {{ $user->activeShip()->current_health }}
                                        /{{ $user->activeShip()->maximum_health }}
                                    </label>
                                    @php $ship = auth()->user()->activeShip(); @endphp
                                    <progress class="experience-bar" max="100" role="progressbar"
                                              aria-valuenow="{{ $ship->levelProgress($ship) }}" aria-valuemin="0"
                                              aria-valuemax="100" value="{{ $ship->levelProgress($ship) }}">
                                        {{ $ship->levelProgress($ship) }} %
                                    </progress>
                                @elseif ($user->activeShip() == null)
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
                                @if ($user->myShips()->count() == 0)
                                    <div class="text-center">
                                        <a href="{{ route('ship_create_beginner') }}" class="btn btn-primary">Create a
                                            free beginner ship</a>
                                    </div>
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
                                <progress class="experience-bar" max="100" role="progressbar"
                                          aria-valuenow="{{ $user->levelProgress($user) }}" aria-valuemin="0"
                                          aria-valuemax="100" value="{{ $user->levelProgress($user) }}">
                                    {{ $user->levelProgress($user) }} %
                                </progress>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/home">
                                        Your cabin
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