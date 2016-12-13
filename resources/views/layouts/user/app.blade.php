<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="_token" content="{{ csrf_token() }}">
        <title>@yield('title')</title>
        <script type="text/javascript" src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/fonts/glyphicons-halflings-regular.woff') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/fonts/glyphicons-halflings-regular.woff2') }}">
        <link rel="stylesheet" href="{{ asset('user/css/layout.css') }}">
        <link rel="stylesheet" href="{{ asset('user/css/custom.css') }}">
    </head>
    <body>
        @include('layouts.user.header')
        <div class="container">
            @include('layouts.user.categories')
            @yield('content')
        </div>
        @include('layouts.user.footer')
    </body>
    <script src="{{ asset('/js/myapp.js') }}"></script>
    <script>
        var myApp = new myApp;
        myApp.init();
        myApp.remove();
    </script>
</html>
