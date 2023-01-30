<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">

    <nav id="sidebarMenu"
       class="collapse d-lg-block sidebar collapse bg-white"
       >
        <div class="position-sticky">
          <div class="list-group list-group-flush mx-3 mt-4">
            <a
               href="#"
               class="list-group-item list-group-item-action py-2 ripple"
               aria-current="true"
               >
              <i class="fas fa-tachometer-alt fa-fw me-3"></i
                ><span>Main dashboard</span>
            </a>
            <a
               href="#"
               class="list-group-item list-group-item-action py-2 ripple active"
               >
              <i class="fas fa-chart-area fa-fw me-3"></i
                ><span>Webiste traffic</span>
            </a>
            <a
               href="#"
               class="list-group-item list-group-item-action py-2 ripple"
               ><i class="fas fa-lock fa-fw me-3"></i><span>Password</span></a
              >
            <a
               href="#"
               class="list-group-item list-group-item-action py-2 ripple"
               ><i class="fas fa-chart-line fa-fw me-3"></i
              ><span>Analytics</span></a
              >
            <a
               href="#"
               class="list-group-item list-group-item-action py-2 ripple"
               >
              <i class="fas fa-chart-pie fa-fw me-3"></i><span>SEO</span>
            </a>
            <a
               href="#"
               class="list-group-item list-group-item-action py-2 ripple"
               ><i class="fas fa-chart-bar fa-fw me-3"></i><span>Orders</span></a
              >
            <a
               href="#"
               class="list-group-item list-group-item-action py-2 ripple"
               ><i class="fas fa-globe fa-fw me-3"></i
              ><span>International</span></a
              >
            <a
               href="#"
               class="list-group-item list-group-item-action py-2 ripple"
               ><i class="fas fa-building fa-fw me-3"></i
              ><span>Partners</span></a
              >
            <a
               href="#"
               class="list-group-item list-group-item-action py-2 ripple"
               ><i class="fas fa-calendar fa-fw me-3"></i
              ><span>Calendar</span></a
              >
            <a
               href="#"
               class="list-group-item list-group-item-action py-2 ripple"
               ><i class="fas fa-users fa-fw me-3"></i><span>Users</span></a
              >
            <a
               href="#"
               class="list-group-item list-group-item-action py-2 ripple"
               ><i class="fas fa-money-bill fa-fw me-3"></i><span>Sales</span></a
              >
          </div>
        </div>
    </nav>

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</body>
</html>
