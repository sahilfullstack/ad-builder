<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    @guest

                    @else
                        <ul class="nav navbar-nav">
                            <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            @can('template.manage')
                                <li><a href="{{ route('templates.list') }}">Templates</a></li>
                            @endcan
                            <li><a href="{{ route('units.list') }}">Ads</a></li>
                            <!-- <li><a href="{{ route('units.list', ['type' => 'page']) }}">Landing Pages</a></li> -->
                            @can('unit.approve')
                                <li><a href="{{ route('units.approval.list') }}">Approve/Reject Unit</a></li>
                            @endcan
                            @can('user.manage')
                                <li><a href="{{ route('users.list') }}">Users</a></li>
                            @endcan
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    Statistical Data <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="/statistics/views-count">
                                            Total Views
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/statistics/views-duration">
                                            Views Duration
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/statistics/views-duration-others">
                                            Competitor's Views Duration
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/statistics/layout-performance">
                                            Layout Performance
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/statistics/subscription-sum">
                                            Total Subscriptions
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/statistics/subscriptions-by-layout">
                                            Subscriptions by layout
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/statistics/views-average-duration">
                                            Average Views Duration
                                        </a>
                                    </li>
                                    <li>
                                        <a href="/statistics/views-average-duration-others">
                                            Competitor's Average Views Duration
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    @endguest

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('users.subscriptions') }}">
                                            Subscription
                                        </a>
                                    </li>
                                    @can('create', Laravel\Passport\Token::class)
                                    <li>
                                        <a href="{{ route('users.access-tokens') }}">
                                            Access Tokens
                                        </a>
                                    </li>
                                    @endcan
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
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
