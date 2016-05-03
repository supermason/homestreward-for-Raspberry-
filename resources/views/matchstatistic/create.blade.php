@extends('wd.admin.main')

@section('content')

    <div class="container top-gap">
        <ul class="nav nav-tabs sub-admin-nav" role="tablist">
            <li role="presentation">
                <a href="{{url('/matchstatistic/exception')}}" aria-controls="index" role="tab" >
                    {{trans('matchStatistic.title')}}
                </a>
            </li>
            <li role="presentation" class="active">
                <a href="javascript:void(0);" aria-controls="index" role="tab" >
                    {{trans('matchStatistic.newException.title')}}
                </a>
            </li>
        </ul>

        <div class="common-form-container">

            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Whoops!</strong>
                    <br/>
                    <br/>
                    <ul>
                        @foreach ($errors->all as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('ok'))
                <div class="alert alert-success alert-dismissable fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>{{session('ok')}}</strong>
                </div>
            @endif

            <form class="form-horizontal" action="{{url('/matchstatistic/exception')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="device" class="col-md-1 control-label">{{trans('matchStatistic.newException.device')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="device" name="device" placeholder="device-name" required>
                    </div>
                    <div class="col-md-2">
                        <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustFill')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="system_version" class="col-md-1 control-label">{{trans('matchStatistic.newException.system_version')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="system_version" name="system_version" placeholder="system_version" required>
                    </div>
                    <div class="col-md-2">
                        <h3><span class="warning-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustFill')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title" class="col-md-1 control-label">{{trans('matchStatistic.newException.exp_title')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="title" name="title" placeholder="title" required>
                    </div>
                    <div class="col-md-2">
                        <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustFill')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="col-md-1 control-label">{{trans('matchStatistic.newException.exception')}}</label>
                    <div class="col-md-9">
                        <textarea class="form-control" id="content" name="content" placeholder="exceptions" rows="4" required></textarea>
                    </div>
                    <div class="col-md-2">
                        <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustFill')}}</span></h3>
                    </div>
                </div>
                <div class="col-md-offset-1 col-md-9">
                    <button type="submit" class="btn btn-success btn-lg btn-fill">{{trans('adminTip.products.addNewProduct.form.pAdd')}}</button>
                </div>
            </form>
        </div>
    </div>

@endsection