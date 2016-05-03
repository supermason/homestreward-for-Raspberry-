@extends('wd.admin.main')

@section('content')

    <div class="banner">
        <div class="container">
            <h1>{{trans('adminTip.banner.title')}}</h1>
            <p>{{trans('adminTip.banner.content')}}</p>
        </div>
    </div>

    <div class="container main-container">
        <div class="main-title">
            <h2>{{trans('adminTip.index.title')}}</h2>
        </div>
        <div class="row">
            <div class="col-md-offset-2 col-md-3 admin-grid">
                <a href="{{url('/wd/admin/products/')}}" class="product-admin">
                    <p>{{trans('adminTip.nav.leftNav.product')}}</p>
                    <p>{{trans('adminTip.index.productAdminInfo')}}</p>
                </a>
            </div>
            <div class="col-md-offset-2 col-md-3 admin-grid">
                <a href="{{url('/wd/admin/activities/')}}" class="activity-admin">
                    <p>{{trans('adminTip.nav.leftNav.activities')}}</p>
                    <p>{{trans('adminTip.index.activityAdminInfo')}}</p>
                </a>
            </div>
        </div>
    </div>

@endsection