<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="_token" content="{{ csrf_token() }}"/>

        <title>JM的小管家</title>

        <link rel="stylesheet" href="{{asset('/css/framework7.ios.min.css')}}" />
        <link rel="stylesheet" href="{{asset('/css/framework7.ios.colors.min.css')}}" />
        <link rel="stylesheet" href="{{asset('/css/app.css')}}"/>

    </head>
    <body>
        <div class="statusbar-overlay"></div>
        <!-- Views -->
        <div class="views theme-blue">
            <!-- Your main view, should have "view-main" class -->
            <div class="view view-main">
                @yield('content')
            </div>
        </div>
    </body>
</html>
