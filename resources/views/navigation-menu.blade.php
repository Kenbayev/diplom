<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="https://airfly.kz"><img src="https://airfly.kz/storage/logo.png" width="32px" alt=""></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 w-100 mb-lg-0">
                
                <li class="nav-item dropdown">
                    <a class="text-sm nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('public.Information')
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="text-sm dropdown-item" href="#">FAQ</a></li>
                        <li><a class="text-sm dropdown-item" href="#">@lang('public.About_platform')</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="text-sm dropdown-item" href="#">@lang('public.Support') <i class="fa fa-envelope-open"></i></a></li>
                    </ul>
                </li>
                @can('user_access')
                <li class="nav-item dropdown">
                    <a class="text-sm nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        @lang('public.Admin_panel')
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                       
                        <li>
                            <a class="text-sm  dropdown-item" href="{{ route('airlines.index') }}" :active="request()->routeIs('airlines.*')">
                                @lang('public.Airlines')
                            </a>
                        </li>
                        <li>
                            <a class="text-sm  dropdown-item" href="{{ route('flights.index') }}" :active="request()->routeIs('flights.*')">
                                @lang('public.Flights')
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="text-sm  dropdown-item" href="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                                @lang('public.Users')
                            </a>
                        </li>
                       
                    </ul>
                </li>
                @endcan
            </ul>
            @if (Route::has('login'))
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-end w-100 rigth_menu">
                <li><a class="text-sm  nav-link" href="locale/en">EN</a></li>
                <li><a class="text-sm  nav-link" href="locale/ru">RU</a></li>
                <li><a class="text-sm  nav-link" href="locale/kz">KZ</a></li>

                @auth
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <li class="nav-item dropdown">
                    <a class="text-sm nav-link dropdown-toggle profile_img" href="#" id="navbarScrollingDropdowns" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarScrollingDropdowns">

                        <li>
                            <a class="text-sm dropdown-item" href="{{ route('profile.show') }}">
                                @lang('public.Profile')
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="text-sm dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                    @lang('public.Logout')
                                </a>
                            </form>
                        </li>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                            {{ __('API Tokens') }}
                        </x-jet-dropdown-link>
                        @endif

                        <!-- <div class="border-t border-gray-100"></div> -->

                        <!-- Team Management -->
                        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Team') }}
                        </div>

                        <!-- Team Settings -->
                        <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                            {{ __('Team Settings') }}
                        </x-jet-dropdown-link>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                            {{ __('Create New Team') }}
                        </x-jet-dropdown-link>
                        @endcan

                        <div class="border-t border-gray-100"></div>

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" />
                        @endforeach

                        <!-- <div class="border-t border-gray-100"></div> -->
                        @endif

                        <!-- Authentication -->


                    </ul>
                </li>
                @else
                <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                    <div>{{ Auth::user()->name }}</div>

                    <div class="ml-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
                @endif
                @else
                <li class="nav-item"><a href="{{ route('login') }}" class="text-sm nav-link"><i class="fa-solid fa-arrow-right-to-bracket"></i></a></li>
                @if (Route::has('register'))
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="text-sm nav-link"><i class="fa-solid fa-user-plus"></i></a>
                </li>
                @endif
                @endauth
            </ul>
            @endif
        </div>
    </div>
</nav>

<!-- <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="container">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>
                @can('user_access')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        @lang('public.Dashboard')
                    </x-jet-nav-link>
                </div>
                @endif

                @can('user_access')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('airlines.index') }}" :active="request()->routeIs('airlines.*')">
                        @lang('public.Airlines')
                    </x-jet-nav-link>
                </div>
                @endif

                @can('user_access')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('flights.index') }}" :active="request()->routeIs('flights.*')">
                        @lang('public.Flights')
                    </x-jet-nav-link>
                </div>
                @endif

                @can('user_access')
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.*')">
                        @lang('public.Users')
                    </x-jet-nav-link>
                </div>
                @endcan
            </div>

            <div class="flex">
                <div class="sm:flex sm:items-center sm:ml-6">

                    <x-jet-dropdown align="right" width="auto">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                @lang('public.language')
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <ul class="list_lang">
                                <li><a href="locale/en">EN</a></li>
                                <li><a href="locale/ru">RU</a></li>
                            </ul>
                        </x-slot>

                    </x-jet-dropdown>
                </div>
                @if (Route::has('login'))
                <ul class="hidden sm:flex auth_menu">
                    @auth
                    @else
                    <li class="nav-item"><a href="{{ route('login') }}" class="text-sm px-2 font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out"><i class="fa-solid fa-arrow-right-to-bracket"></i></a></li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="text-sm px-2 font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">Register</a>
                    </li>
                    @endif
                    @endauth
                </ul>
                @endif


                @can('user_access')
                <div class="hidden sm:flex sm:items-center sm:ml-6">

                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Team') }}
                            </div>
                            <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                {{ __('Team Settings') }}
                            </x-jet-dropdown-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                {{ __('Create New Team') }}
                            </x-jet-dropdown-link>
                            @endcan

                            <div class="border-t border-gray-100"></div>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                            <x-jet-switchable-team :team="$team" />
                            @endforeach

                            <div class="border-t border-gray-100"></div>
                            @endif

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                    {{ __('Logout') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
                @endcan
            </div>




            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
        </div>

        @if (Route::has('login'))
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-end w-100 rigth_menu">
            @auth
            <li class="nav-item"><a href="{{ url('/dashboard') }}" class="text-sm nav-link">Dashboard</a></li>
            @else
            <li class="nav-item"><a href="{{ route('login') }}" class="text-sm nav-link">Log in</a></li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a href="{{ route('register') }}" class="text-sm nav-link">Register</a>
            </li>
            @endif
            @endauth
        </ul>
        @endif

        @can('user_access')
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <img class="h-10 w-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>

                <div class="ml-3">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                    {{ __('API Tokens') }}
                </x-jet-responsive-nav-link>
                @endif
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Logout') }}
                    </x-jet-responsive-nav-link>
                </form>

                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div>

                <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                    {{ __('Team Settings') }}
                </x-jet-responsive-nav-link>

                <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                    {{ __('Create New Team') }}
                </x-jet-responsive-nav-link>

                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Switch Teams') }}
                </div>

                @foreach (Auth::user()->allTeams() as $team)
                <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                @endforeach
                @endif
            </div>
        </div>
        @endcan
    </div>
</nav> -->