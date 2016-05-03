@extends('wd.admin.main')

@section('content')

    <div class="container top-gap">
        <ul class="nav nav-tabs sub-admin-nav" role="tablist">
            <li role="presentation" class="active">
                <a href="javascript:void(0);" aria-controls="index" role="tab" >
                    {{trans('adminTip.products.productList.title')}}
                </a>
            </li>
            <li role="presentation">
                <a href="{{url('/wd/admin/products/create')}}" aria-controls="create" role="tab" >
                    {{trans('adminTip.products.addNewProduct.title')}}
                </a>
            </li>
            <li role="presentation">
                <a href="javascript:void(0);" aria-controls="edit" role="tab" >
                    {{trans('adminTip.products.editProduct.title')}}
                </a>
            </li>
        </ul>
        <div class="product-content table-responsive">
            <form method="get" action="{{url('/wd/admin/products')}}" enctype="application/x-www-form-urlencoded">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="input-group">
                    <input type="text" name="keywords" class="form-control" placeholder="Search for..." value="{{$data["keywords"]}}">
                    <span class="input-group-btn">
                        <button class="btn btn-danger" type="submit">Go!</button>
                    </span>
                </div>
            </form>

            <table class="table table-striped table-hover ">
                <thead>
                    <tr>
                        <th>{{trans('adminTip.products.productList.pInfo.thumbnail')}}</th>
                        <th>{{trans('adminTip.products.productList.pInfo.name')}}</th>
                        {{--<th>{{trans('adminTip.products.productList.pInfo.subtitle')}}</th>--}}
                        <th>{{trans('adminTip.products.productList.pInfo.inventory')}}</th>
                        <th>{{trans('adminTip.products.productList.pInfo.retailPrice')}}</th>
                        <th>{{trans('adminTip.products.productList.pInfo.wholesalePrice')}}</th>
                        <th>{{trans('adminTip.products.productList.pInfo.operation')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($data['products']) == 0)
                        <tr>
                            <td colspan="7" style="text-align: center">{{trans('adminTip.products.productList.noItem')}}</td>
                        </tr>
                    @else
                        @foreach ($data['products'] as $product)
                            <tr>
                                <td><img src="{{App\Util\WdUtil::getProductImgUrl($product->category_id, $product->thumbnail)}}" class="thumbnail product-img"/></td>
                                <td><strong>{{$product->name}}</strong></td>
                                {{--<td>{{$product->subtitle}}</td>--}}
                                <td><span {{App\UI\UITool::hasEnough($product->count)}}>{{$product->count}}</span></td>
                                <td><span class="normal-price">{{$product->retail_price}}</span></td>
                                <td>{{$product->wholesale_price}}</td>
                                <td><a href="{{url('/wd/admin/products/'.$product->id.'/edit/')}}" class="btn btn-danger btn-sm">{{trans('adminTip.products.productList.edit')}}</a> </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

            <div class="page-info">
                <p><code>{{strtr(trans('adminTip.products.pagination'), ['@' => '16', '#' => $data['products']->total()])}}</code></p>
            </div>
        </div>
        {!! $data['products']->render() !!}
    </div>

@endsection