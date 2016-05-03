@extends('wd.admin.main')

@section('content')

    <div class="container top-gap">
        <ul class="nav nav-tabs sub-admin-nav" role="tablist">
            <li role="presentation" class="active">
                <a href="javascript:void(0);" aria-controls="edit" role="tab" >
                    {{trans('adminTip.wdInfo.editInfo.title')}}
                </a>
            </li>
        </ul>

        <div class="common-form-container">

            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Whoops!</strong>{{ trans('adminTip.wdInfo.editInfo.errors.title') }}
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

            <form class="form-horizontal" action="{{url('/wd/admin/info/' . $data["wdInfo"]->id)}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="put">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="title" class="col-md-1 control-label">{{trans('adminTip.wdInfo.editInfo.form.iTitle')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="title" name="title" placeholder="{{trans('adminTip.wdInfo.editInfo.form.iTitleTip')}}" required value="{{$data["wdInfo"]->title}}">
                    </div>
                    <div class="col-md-2">
                        <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustFill')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="curLogo" class="col-md-1 control-label">{{trans('adminTip.wdInfo.editInfo.form.iCurLogo')}}</label>
                    <div class="col-md-9">
                        <img src="{{asset('/img/wd/' . $data["wdInfo"]->logo)}}" class="img-responsive editable-img" id="curLogo"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="logo" class="col-md-1 control-label">{{trans('adminTip.wdInfo.editInfo.form.iLogo')}}</label>
                    <div class="col-md-9">
                        <input type="file" id="logo" name="logo" accept="image/*">
                    </div>
                </div>
                <div class="form-group">
                    <label for="curQrImg" class="col-md-1 control-label">{{trans('adminTip.wdInfo.editInfo.form.iCurQrImg')}}</label>
                    <div class="col-md-9">
                        <img src="{{asset('/img/wd/' . $data['wdInfo']->qr_img)}}" class="img-responsive editable-img" id="curQrImg"/>
                    </div>
                </div>
                <div class="form-group">
                    <label for="qrImg" class="col-md-1 control-label">{{trans('adminTip.wdInfo.editInfo.form.iQrImg')}}</label>
                    <div class="col-md-9">
                        <input type="file" id="qrImg" name="qrImg" accept="image/*">
                    </div>
                </div>
                <div class="form-group">
                    <label for="content" class="col-md-1 control-label">{{trans('adminTip.wdInfo.editInfo.form.iContent')}}</label>
                    <div class="col-md-9">
                        <textarea class="form-control" id="content" name="content" placeholder="{{trans('adminTip.wdInfo.editInfo.form.iContentTip')}}" rows="4" required>{{$data["wdInfo"]->content}}</textarea>
                    </div>
                    <div class="col-md-2">
                        <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustFill')}}</span></h3>
                    </div>
                </div>
                <div class="col-md-offset-1 col-md-9">
                    <button type="submit" class="btn btn-success btn-lg btn-fill">{{trans('adminTip.products.editProduct.form.pEdit')}}</button>
                </div>
            </form>
        </div>
    </div>

@endsection