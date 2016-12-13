<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="">@lang('header.home')</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a class="shop-name" href="{{ url('/login') }}">@lang('login.login')</a></li>
                    <li><a class="shop-name" href="{{ url('/register') }}">@lang('register.register')</a></li>
                @else
                <li class="dropdown">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ route('users.edit', Auth::user()) }}"><i class="fa fa-btn fa-edit">
                             @lang('header.profile')</i></a></li>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i> @lang('header.logout')</a> 
                                <form id="logout-form" action="{{ url('/logout') }}" method="POST">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                </li>
                @endif
            </ul>
        </div>   
    </div>
</nav>
<div class="head-top col-md-12 col-sm-12 col-xs-12">
    <div class="col-md-8 col-sm-8 col-xs-8">
        <a href="" class="img-responsive">
            <img src="{{ asset('images/logo.png') }}">
        </a>
    </div>
    <div class="col-md-4 col-sm-4 col-xs-4">
        <div class="dropdown search col-md-4 col-sm-4 col-xs-4 padding-zero">
            <button class="btn btn-default dropdown-toggle wid100" type="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true">
                @lang('header.all') <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="">@lang('header.action')</a></li>
            </ul>
        </div>
        <form class="header-search col-md-8 col-sm-8 col-xs-8">
            <div class="input-group">
                <input type="text" class="form-control search" placeholder="Search">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
