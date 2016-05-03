<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{trans('adminTip.pageTitle')}}">
    <meta name="keywords" content="weixin, wd, weishang">
    <meta name="author" content="Mason Ding: <jijiiscoming@hotmail.com>">
    <!-- Favicons -->
    <link rel="icon" href="/img/wd/favicon.ico">

    <title>{{trans('adminTip.pageTitle')}}</title>

    <link href="{{asset('/css/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/bootstrap/bootstrap-theme.min.css')}}" rel="stylesheet">
    <link href="{{asset('/css/admin.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body role="document">

    @yield('bodyContent')

    <script src="{{asset('/js/lib/jquery.2.1.4.min.js')}}"></script>
    <script src="{{asset('js/lib/bootstrap.min.js')}}"></script>
</body>
</html>