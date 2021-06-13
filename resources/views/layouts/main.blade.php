<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="mnb navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="ic fa fa-bars"></i>
                    </button>
                    <div style="padding: 15px 0;">
                        <a href="#" id="msbo"><i class="ic fa fa-bars"></i></a>
                    </div>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right ml-auto">
                        @foreach (config('app.available_locales') as $locale)
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route(\Illuminate\Support\Facades\Route::currentRouteName(), $locale) }}" 
                                @if (app()->getLocale() == $locale) style="font-weight: bold; text-decoration: underline" @endif>{{ strtoupper($locale) }}</a>
                        </li>
                        @endforeach                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle link-nav" data-toggle="dropdown" role="button"
                                aria-haspopup="true" aria-expanded="false"> {{ Auth::user()->name }} <span
                                    class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">{{ __('navbar.settings') }}</a></li>
                                <li><a href="#">{{ __('navbar.help') }}</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="{{ route('logout', app()->getLocale()) }}" onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                        {{ __('navbar.logout') }}
                                    </a></li>
                                <form id="logout-form" action="{{ route('logout', app()->getLocale()) }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </ul>
                        </li>
                        <li><a class="link-nav" href="#"><i class="fa fa-bell-o"></i></a></li>
                        <li><a class="link-nav" href="#"><i class="fa fa-comment-o"></i></a></li>
                    </ul>
                    {{-- <form class="navbar-form navbar-right">
                        <input type="text" class="form-control" placeholder="Search...">
                    </form> --}}
                </div>
            </div>
        </nav>
        <!--msb: main sidebar-->
        <div class="msb" id="msb">
            <nav class="navbar navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <div class="brand-wrapper">
                        <!-- Brand -->
                        <div class="brand-name-wrapper">
                            <a class="navbar-brand link-nav" href="{{ route('home', app()->getLocale()) }}">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Main Menu -->
                <div class="side-menu-container">
                    <ul class="nav navbar-nav">
                        <li class="{{ Route::is('home') ? 'active' : '' }}"><a class="link-nav"
                                href="{{ route('home', app()->getLocale()) }}"><i class="fa fa-home"></i>
                                {{ __('navbar.home_page') }}</a></li>
                        <li class="{{ Route::is('notes.index') ? 'active' : '' }}"><a class="link-nav"
                                href="{{ route('notes.index', app()->getLocale()) }}"><i class="fa fa-sticky-note"></i>
                                {{ __('navbar.my_note') }}</a></li>
                        <!-- Dropdown-->
                        <li class="panel panel-default {{ Route::is('tasks.index', 'tasks.completed') ? 'active' : '' }}"
                            id="dropdown">
                            <a class="link-nav" data-toggle="collapse" href="#dropdown-lvl1">
                                <i class="fa fa-list"></i> {{ __('navbar.my_task') }}
                                <span class="caret"></span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id="dropdown-lvl1"
                                class="panel-collapse collapse {{ Route::is('tasks.index', 'tasks.completed') ? 'in show' : '' }}">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li class="{{ Route::is('tasks.index') ? 'active' : '' }}"><a class="link-nav"
                                                href="{{ route('tasks.index', app()->getLocale()) }}"><i
                                                    class="fa fa-refresh"></i>
                                                {{ __('navbar.active_task') }}</a></li>
                                        <li class="{{ Route::is('tasks.completed') ? 'active' : '' }}"><a
                                                class="link-nav"
                                                href="{{ route('tasks.completed', app()->getLocale()) }}"><i
                                                    class="fa fa-check"></i>
                                                {{ __('navbar.completed_task') }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
