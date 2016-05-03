@extends('wd.admin.main')

@section('content')

    <div class="container top-gap">
        <ul class="nav nav-tabs sub-admin-nav" role="tablist">
            <li role="presentation">
                <a href="{{url('/wd/admin/products/')}}" aria-controls="index" role="tab" >
                    {{trans('adminTip.products.productList.title')}}
                </a>
            </li>
            <li role="presentation" class="active">
                <a href="javascript:void(0);" aria-controls="create" role="tab" >
                    {{trans('adminTip.products.addNewProduct.title')}}
                </a>
            </li>
            <li role="presentation">
                <a href="javascript:void(0);" aria-controls="edit" role="tab" >
                    {{trans('adminTip.products.editProduct.title')}}
                </a>
            </li>
        </ul>

        <div class="common-form-container">

            @if (count($errors) > 0)
                <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Whoops!</strong>{{ trans('adminTip.products.addNewProduct.errors.title') }}
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

            <form class="form-horizontal" action="{{url('/wd/admin/products')}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pName')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="name" name="name" placeholder="{{trans('adminTip.products.addNewProduct.form.pNameTip')}}" required>
                    </div>
                    <div class="col-md-2">
                       <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustFill')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="subtitle" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pSubtitle')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="{{trans('adminTip.products.addNewProduct.form.pSubtitleTip')}}">
                    </div>
                    <div class="col-md-2">
                        <h3><span class="warning-left-arrow"></span><span class="label label-warning">{{trans('adminTip.products.form.recommend')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="productImg" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pImg')}}</label>
                    <div class="col-md-9">
                        <input type="file" id="productImg" name="productImg" required accept="image/*">
                    </div>
                    <div class="col-md-2">
                        <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustSelect')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="category" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pCategory')}}</label>
                    <div class="col-md-9">
                        <select class="form-control" id="category" name="category">
                            @foreach($data['pCategory'] as $category)
                                <option value="{{$category->product_category}}">{{$category->label}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="purchasePrice" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pPurchasePrice')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="price" name="purchasePrice" placeholder="{{trans('adminTip.products.addNewProduct.form.pPurchasePriceTip')}}" required>
                    </div>
                    <div class="col-md-2">
                        <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustFill')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="price" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pPrice')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="price" name="price" placeholder="{{trans('adminTip.products.addNewProduct.form.pPriceTip')}}" required>
                    </div>
                    <div class="col-md-2">
                        <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustFill')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="wholesalePrice" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pWholesalePrice')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="wholesalePrice" name="wholesalePrice" placeholder="{{trans('adminTip.products.addNewProduct.form.pWholesalePriceTip')}}" required>
                    </div>
                    <div class="col-md-2">
                        <h3><span class="danger-left-arrow"></span><span class="label label-danger">{{trans('adminTip.products.form.mustFill')}}</span></h3>
                    </div>
                </div>
                <div class="form-group">
                    <label for="count" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pCount')}}</label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" id="count" name="count" placeholder="{{trans('adminTip.products.addNewProduct.form.pCountTip')}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="description" class="col-md-1 control-label">{{trans('adminTip.products.addNewProduct.form.pDescription')}}</label>
                    <div class="col-md-9">
                        <textarea type="text" class="form-control" id="description" name="description" placeholder="{{trans('adminTip.products.addNewProduct.form.pDescriptionTip')}}" rows="4"  required></textarea>
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