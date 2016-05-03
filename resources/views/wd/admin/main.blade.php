
@extends('wd.admin.htmltemplate')

@section('bodyContent')

    <!-- Fixed navbar -->
    <nav class="navbar admin-navbar">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{url('/wd/admin')}}"><img src="{{asset('/img/wd/admin/wd_admin_logo_reverse.png')}}"></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav admin-nav">
                    {!! App\UI\Navigation\NavigationCreator::createTopNavContent() !!}
                </ul>
                <ul class="nav navbar-nav admin-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">{{trans('adminTip.nav.rightNav.login')}}</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{trans('adminTip.nav.rightNav.welcome')}}&nbsp;<span class="fa fa-user"></span>&nbsp;{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu admin-dropdown-menu" role="menu">
                                <li>
                                    <a href="{{url('/')}}">
                                        {{trans('adminTip.nav.rightNav.goToHS')}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('/wd')}}">
                                        {{trans('adminTip.nav.rightNav.goToWD')}}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('/auth/logout') }}">
                                        {{trans('adminTip.nav.rightNav.logout')}}
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    @include('wd.admin.footer')

@endsection
