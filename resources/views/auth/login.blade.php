@extends('app')

@section('content')

    <!-- Pages container, because we use fixed-through navbar and toolbar, it has additional appropriate classes-->
    <div class="pages navbar-through" >
        <!-- Page, "user-page" contains page name -->
        <div data-page="login" class="page no-toolbar no-swipeback">
            <!-- Scrollable page content -->
            <div class="page-content login-screen-content">
                <div class="login-screen-title">
                    欢迎登录JM的小管家
                </div>
                <div class="content-block center">
                    <img src="{{asset('/img/h/logo.png')}}">
                </div>
                @if (count($errors) > 0)
                    <div class="content-block error">
                        <strong>登录失败！</strong>
                        <br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>
                                    <p>{{ $error }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form role="form" method="POST" action="{{ url('/auth/login') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="list-block inset">
                        <ul>
                            <li>
                                <div class="item-content">
                                    <div class="item-media"><i class="icon icon-form-email"></i></div>
                                    <div class="item-inner">
                                        <div class="item-input">
                                            <input type="email" name="email" placeholder="请输入登录邮箱" required />
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content">
                                    <div class="item-media"><i class="icon icon-form-password"></i></div>
                                    <div class="item-inner">
                                        <div class="item-input">
                                            <input type="password" name="password" placeholder="请输入密码" required pattern="^\S{4,15}$" title="请输入4-15个字" />
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="item-content">
                                    <div class="item-inner">
                                        <div class="item-input">
                                            <small class="color-gray">记住我</small>
                                            <label class="label-switch color-blue">
                                                <input type="checkbox" name="remember"/>
                                                <div class="checkbox"></div>
                                            </label>
                                        </div>
                                        <div class="item-title label"></div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="content-block">
                        <input type="submit" class="button button-big" value="登录"/>
                    </div>
                </form>
                <div class="copyright">
                    <a href="{{url('/auth/register')}}" class="item-link">注册</a> | <a href="#" class="item-link">忘记密码</a>
                </div>
            </div>
        </div>
    </div>

@endsection