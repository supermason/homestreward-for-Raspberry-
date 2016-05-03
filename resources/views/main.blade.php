@extends('app')

@section('content')
        <!-- Top Navbar-->
    <div class="navbar">
        <div class="navbar-inner">
            <div class="left"></div>
            <!-- We need cool sliding animation on title element, so we have additional "sliding" class -->
            <div class="center sliding">Account Keeper</div>
            <div class="right"></div>
        </div>
    </div>

<!-- Pages container, because we use fixed-through navbar and toolbar, it has additional appropriate classes-->
    <div class="pages navbar-through" >
        <div data-page="main" class="page no-toolbar no-swipeback">
            <div class="page-content">
                <div class="content-block-title">功能选择</div>
                <div class="content-block">
                    <div class="content-block-inner">
                        <div class="item-content">
                            <div class="item-link">
                                <a href="{{url('/bill/')}}" class="button">记帐</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection