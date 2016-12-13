<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Shoppe') }}</title>

    <!-- Styles -->
    {{ Html::style('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}
    {{ Html::style('/bower_components/font-awesome/css/font-awesome.min.css') }}
    {{ Html::style('/bower_components/sweetalert2/dist/sweetalert2.css') }}
    {{ Html::style('/css/app.css') }}
    {{ Html::style('/css/header.css') }}
    @yield('style')

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">@lang('login.toggle')</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" id="shop-name" href="{{ url('/') }}">
                        {{ config('app.name', 'Shoppe') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a id="shop-name" href="{{ url('/login') }}">@lang('login.login')</a></li>
                            <li><a id="shop-name" href="{{ url('/register') }}">@lang('register.register')</a></li>
                        @else
                            <li><a id="shop-name">{{ Auth::user()->name }}</a></li>
                            <li><a id="logout" href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> 
                            @lang('login.logout')</a>
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    {{ Html::script('/bower_components/jquery/dist/jquery.min.js') }}
    {{ Html::script('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}
    {{ Html::script('/bower_components/sweetalert2/dist/sweetalert2.min.js') }}
    {{ Html::script('/bower_components/firebase/firebase.js') }}
    {{ Html::script('/js/app.js') }}
    {{ Html::script('/js/myapp.js') }}
    <script>
        var myApp = new myApp;
        myApp.init();
    </script>
    @yield('script')
</body>
</html>
