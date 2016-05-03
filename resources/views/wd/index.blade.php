<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- Your app title -->
    <title>{{trans('tip.shopTitle')}}</title>
    <!-- Path to Framework7 Library CSS, iOS Theme -->
    <link rel="stylesheet" href="/css/framework7.ios.min.css">
    <!-- Path to Framework7 color related styles, iOS Theme -->
    <link rel="stylesheet" href="/css/framework7.ios.colors.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- Path to your custom app styles-->
    <link rel="stylesheet" href="/css/wd.css">
    <!-- Favicons -->
    <link rel="icon" href="/img/wd/favicon.ico">
</head>
<body>
<!-- Status bar overlay for full screen mode (PhoneGap) -->
<div class="statusbar-overlay"></div>
<div class="panel-overlay"></div>
<div class="panel panel-left-add panel-left panel-reveal p-category-list">
    <div class="content-block-title"><p>{{trans('tip.leftPanel.naviTitle')}}</p></div>
    <div class="list-block media-list">
        <ul>
            @foreach($data['menu'] as $menu)
            <li>
                <a href="#" data-panel="left" data-category="{{$menu->product_category}}" class="item-link item-content close-panel">
                    <div class="item-media"><img src="{{asset($menu->icon)}}"> </div>
                    <div class="item-inner">
                        <div class="item-title-row">
                            <div class="item-title">{{$menu->label}}</div>
                            <div class="item-after">{{$menu->after_txt}}</div>
                        </div>
                        <div class="item-text">{{$menu->description}}</div>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="panel logo-panel panel-right panel-reveal">
    <div class="content-block">
        <div class="content-block-inner">
            <div class="logo">
                <img src="{{asset('img/wd/' . $data['wdInfo']->logo . '')}}" />
            </div>
        </div>
    </div>
    <div class="content-block-title">
        {{$data['wdInfo']->title}}
    </div>
    <div class="content-block">
       <p>{{$data['wdInfo']->content}}</p>
    </div>
    <div class="content-block">
        <img class="img-responsive" src="{{asset('/img/wd/' . $data['wdInfo']->qr_img . '')}}" />
    </div>
</div>
<!-- Views -->
<div class="views toolbar-through theme-wd">
    <!-- Your main view, should have "view-main" class -->
    <div class="view view-main">
        <!-- Top Navbar-->
        <div class="navbar">
            <div class="navbar-inner">
                <div class="left sliding">
                    <a href="#" data-panel="left" class="link icon-only open-panel">
                        <i class="fa fa-heart"></i>
                    </a>
                </div>
                <!-- We need cool sliding animation on title element, so we have additional "sliding" class -->
                <div class="center sliding">
                    <span class="wd-title"></span>
                </div>
                <div class="right">
                    <a href="#" data-panel="right" class="link icon-only open-panel">
                        <i class="fa fa-info-circle"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- Pages container, because we use fixed-through navbar and toolbar, it has additional appropriate classes-->
        <div class="pages navbar-through">
            <!-- Page, "data-page" contains page name -->
            <div data-page="home-page" class="page">
                <!-- Search bar with "searchbar-init" class for auto initialization -->
                <form class="searchbar searchbar-init">
                    <div class="searchbar-input">
                        <input type="search" placeholder="{{trans('tip.search.keywords')}}"  >
                        <a href="#" class="searchbar-clear"></a>
                    </div>
                    <a href="#" class="searchbar-cancel">{{trans('tip.cancel')}}</a>
                </form>
                <!-- Search bar overlay -->
                <div class="searchbar-overlay"></div>
                <!-- Scrollable page content -->
                <div class="page-content pull-to-refresh-content infinite-scroll" data-distance="100">
                    <!-- default pull layer -->
                    <div class="pull-to-refresh-layer">
                        <div class="preloader"></div>
                        <div class="pull-to-refresh-arrow"></div>
                    </div>

                    <div class="swiper-container swiper-container-horizontal" data-speed="400" data-pagination=".swiper-pagination">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"><img class="img-banner" src="{{asset('/img/wd/banner/banner_jie.jpg')}}"></div>
                            <div class="swiper-slide"><img class="img-banner" src="{{asset('/img/wd/banner/banner_jie.jpg')}}"></div>
                            <div class="swiper-slide"><img class="img-banner" src="{{asset('/img/wd/banner/banner_jie.jpg')}}"></div>
                            <div class="swiper-slide"><img class="img-banner" src="{{asset('/img/wd/banner/banner_jie.jpg')}}"></div>
                            <div class="swiper-slide"><img class="img-banner" src="{{asset('/img/wd/banner/banner_jie.jpg')}}"></div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                    <div class="content-block-title product-list-title"></div>
                    <div class="list-block cards-list searchbar-found" >
                        <ul>
                            @if (count($data['products']) == 0)
                                <li class="not-found">
                                    {{trans('tip.search.notFound')}}
                                </li>
                            @else
                                @foreach($data['products'] as $product)
                                    <li  class="card wd-card-header-pic">
                                        <div data-background="{{App\Util\WdUtil::getProductImgUrl($product->category_id, $product->thumbnail)}}" valign="bottom" class="card-header color-white no-border lazy lazy-fadeIn"><h2>{{$product->name}}</h2></div>
                                        <div class="card-content">
                                            <div class="card-content-inner">
                                                <p class="color-gray">{{$product->subtitle}}</p>
                                                <p>{{$product->description}}</p>
                                                <p>{{trans('tip.pList.priceTitle')}}<span class="normal-price">300.00</span><span class="discount">220.00</span></p>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            @if (!Auth::guest())
                                                <a href="{{url('/wd/admin/products/'.$product->id.'/edit/')}}" class="link external">{{trans('adminTip.products.productList.edit')}}</a>
                                            @else
                                                <a href="javascript:void(0);"></a>
                                            @endif
                                            <a href="#" class="link">{{trans('tip.pList.detail')}}</a>
                                        </div>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>

                    <!-- 加载提示符 -->
                    <div class="infinite-scroll-preloader center {{count($data['products']) > 0 ? "" : "hidden"}}">
                        <div class="preloader"></div>
                    </div>
                    {{--没有更多内容的提示--}}
                    <div class="list-block-label hidden">
                        <p style="text-align:center;">{{trans('tip.search.hasNoMore')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Path to your app js-->
<script data-main="/js/wd/main" src="{{asset('/js/lib/require.js')}}"></script>
</body>
</html>
